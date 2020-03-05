<?php

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

defined('_JEXEC') or die;
extract($displayData);

HTMLHelper::_('behavior.modal');

HTMLHelper::_('stylesheet','lib_fields/quantumuploadimage/field.css', [
	'version' => filemtime(__FILE__),
	'relative' => true
]);

HTMLHelper::_('script', 'lib_fields/quantumuploadimage/field.js', [
	'version' => filemtime(__FILE__),
	'relative' => true
]);



$app = Factory::getApplication();
$img = !empty($displayData['value']) ? '/' . $displayData['value'] : '';
$value = $displayData['value'];

$app->getSession()->set('quantummanageraddscripts', json_encode([
	'lib_fields/quantumuploadimage/modal.js'
]));

$quantumOptions = [
	'option' => 'com_quantummanager',
	'tmpl' => 'component',
	'layout' => 'modal',
	'fieldid' => $displayData['id'],
];

?>

<div class="<?php if(isset($displayData['uploadAreaHidden']) && !(int)$displayData['uploadAreaHidden']) : ?>quantumuploadimage-preview-hidden<?php endif; ?>">
    <div class="quantumuploadimage-preview">
        <?php if(empty($img)) : ?>
            <div class="drag-drop">
                <div>
                    <div class="quantummanager-icon quantummanager-icon-upload"></div>
                    <div><?php echo Text::_('COM_QUANTUMMANAGER_QUANTUMUPLOAD_UPLOAD_DROP') . ' ' . Text::_('COM_QUANTUMMANAGER_QUANTUMUPLOAD_UPLOAD_SELECT') ?></div>
                </div>
            </div>
		<?php else: ?>
            <img src="<?php echo $img ?>" />
		<?php endif; ?>
    </div>
    <div class="quantumuploadimage-actions">
        <input type="text" name="<?php echo $displayData['name'] ?>" id="<?php echo $displayData['id'] ?>" value="<?php echo $value ?>" class="quantumuploadimage-input">
        <div class="quantumuploadimage-group-buttons">
            <button class="btn quantumuploadimage-upload-start"><?php echo Text::_('COM_QUANTUMMANAGER_ACTION_UPLOADING') ?></button>
            <button class="btn quantumuploadimage-change"
               aria-hidden="true"
               data-source-href="index.php?<?php echo http_build_query($quantumOptions) ?>"
               rel="{handler: 'iframe', size: {x: 1450, y: 700}, classWindow: 'quantummanager-modal-sbox-window'}"><?php echo Text::_('COM_QUANTUMMANAGER_ACTION_SELECT') ?></button>
            <button class="btn quantumuploadimage-delete" aria-hidden="true"><span class="icon-remove"></span></button>
        </div>
    </div>
</div>

<script type="text/javascript">
    window.QuantumuploadimageLang = {
        'dragdrop': '<?php echo Text::_('COM_QUANTUMMANAGER_QUANTUMUPLOAD_UPLOAD_DROP') . ' ' . Text::_('COM_QUANTUMMANAGER_QUANTUMUPLOAD_UPLOAD_SELECT') ?>'
    };
</script>