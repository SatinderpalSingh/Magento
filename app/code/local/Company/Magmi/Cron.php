<?php

require_once(dirname(__FILE__) . "/../../../../../magmi/plugins/inc/magmi_datasource.php");
require_once(dirname(__FILE__) . "/../../../../../magmi/integration/productimport_datapump.php");

class Company_Magmi_Cron {

    public function magmiUpdate()
    {
        $items = array(); // build your own list of items to create/update

        $this->import($items);
    }

    private function import($items, $mode = 'create', $indexes = 'all')
    {
        if (count($items) > 0) {
            $dp = new Magmi_ProductImport_DataPump();
            $dp->beginImportSession("default", $mode);
            foreach ($items as $item) {
                $dp->ingest($item);
            }
            $dp->endImportSession();
            $this->reindex($indexes);
        }
    }

    private function reindex($string = 'all')
    {
        /** @var $indexer Mage_Index_Model_Indexer */
        $indexer = Mage::getModel('index/indexer');

        $processes = array();

        if ($string == 'all') {
            $processes = $indexer->getProcessesCollection();
        } else {
            $codes = explode(',', $string);
            foreach ($codes as $code) {
                $process = $indexer->getProcessByCode(trim($code));
                if ($process) {
                    $processes[] = $process;
                }
            }
        }

        /** @var $process Mage_Index_Model_Process */
        foreach ($processes as $process) {
            $process->reindexEverything();
        }
    }
}
