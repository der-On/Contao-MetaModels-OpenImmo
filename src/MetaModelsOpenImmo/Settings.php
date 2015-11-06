<?php

/**
 *
 * PHP version 5
 * @copyright  Ondrej Brinkel 2014
 * @author     Ondrej Brinkel
 * @package    MetaModelsOpenImmo
 * @license    MIT
 * @filesource
 */

namespace MetaModelsOpenImmo;

/**
 * Class Settings
 *
 * @copyright  Ondrej Brinkel 2014
 * @author     Ondrej Brinkel
 * @package    Controller
 */
class Settings extends \BackendModule
{
    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'be_metamodels_openimmo_settings';

    /**
     * Generate module
     */
    protected function compile()
    {
      $this->Template->messages = '';

      if ($this->Input->post('FORM_SUBMIT') == 'be_metamodels_openimmo_import_template') {
        try {
          $this->importTemplate($this->Input->post('version'));
        } catch (Exception $error) {
          $this->Template->messages .= $error;
        } finally {
          $this->Template->messages .= '<div class="tl_green">Template importiert.</div>';
        }
      }

      $this->Template->versions = scandir(TL_ROOT . '/system/modules/metamodels_openimmo/sql_templates/versions');

      $this->Template->versions = array_filter($this->Template->versions, function ($file) {
        return strpos($file, '.sql') !== false;
      });

      $this->Template->versions = array_map(function ($file) {
        return str_replace('.sql', '', $file);
      }, $this->Template->versions);
    }

    protected function importTemplate($version) {
      $file = TL_ROOT . '/system/modules/metamodels_openimmo/sql_templates/versions/' . $version . '.sql';

      $this->importSqlDump($file);
      $this->importSqlDump(TL_ROOT . '/system/modules/metamodels_openimmo/sql_templates/mm_immo.sql');
    }

    protected function importSqlDump($file) {
        // start import
      $templine = '';
      $lines = file($file);

      foreach ($lines as $line)
      {
          // Skip it if it's a comment
          if (substr($line, 0, 2) == '--' || $line == '')
          continue;

          // skip LOCK TABLES statements
          if (strpos($line, 'LOCK TABLES') !== false)
          continue;

          // Add this line to the current segment
          $templine .= $line;
          // If it has a semicolon at the end, it's the end of the query
          if (substr(trim($line), -1, 1) == ';')
          {
              // Perform the query
              try {
                  $this->Database->execute($templine);
              } catch(Error $error) {

              }
              // Reset temp variable to empty
              $templine = '';
          }
      }
    }
}
