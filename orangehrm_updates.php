<?php

if (file_exists('symfony/config/databases.yml')) {
    define('SF_APP_NAME', 'orangehrm');
    
    require_once(dirname(__FILE__) . '/symfony/config/ProjectConfiguration.class.php');
    $configuration = ProjectConfiguration::getApplicationConfiguration(SF_APP_NAME, 'prod', true);
    new sfDatabaseManager($configuration);
    $context = sfContext::createInstance($configuration);
    $i18n = $context->getI18N();

    try {
        if ($xml = @simplexml_load_file("http://www.orangehrm.com/global_update/orangehrm_updates.xml")) {
            foreach ($xml->children() as $child) {
                $data[] = $child;
            }
            for ($i = 0; $i < count($data); $i = $i + 3) {
                echo "<div style='width: auto; float:right; margin: 12px 2px 0px 0px;'>
				<table border='0'>
					<tr><td><a href='" . $data[$i] . "' target='_blank' style='text-decoration:none;'><font style='color:green; font-weight:bold; font-size:12px;'>" . $i18n->__($data[$i + 1]) . "</font>&nbsp;&nbsp;</td></tr>
					<tr><td align='center'><a href='" . $data[$i] . "' target='_blank' style='text-decoration:none;'><font style='font-size:10px; font-weight:bold;'>" . $i18n->__($data[$i + 2]) . "</font></a></td></tr>
				</table>
			      </div>";
            }
        } else {
            echo "";
        }
    } catch (exception $e) {
        echo "";
    }
}