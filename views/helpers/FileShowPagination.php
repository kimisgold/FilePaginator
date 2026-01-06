<?php
/**
 * View helper for previous and next links on file show views.
 * 
 * @package FilePaginator\View\Helper
 */
class FilePaginator_View_Helper_FileShowPagination extends Zend_View_Helper_Abstract
{
    public function fileShowPagination()
    {
        $currentController = Zend_Controller_Front::getInstance()->getRequest()->getControllerName(); 
        $html = '';
        if ($currentController == 'files') {
            $file = get_current_record('file');
            $originalItem = $file->getItem();
            $originalItemFiles = $originalItem->getFiles();

            if (count($originalItemFiles) > 1) {
                $html .= '<nav id="file-show-pagination" class="item-pagination"><ul class="navigation">';
                $originalItemOrder = metadata($file, 'order');
                if (array_key_exists($originalItemOrder - 2, $originalItemFiles)) {
                    $previousFile = $originalItemFiles[$originalItemOrder - 2];
                    $html .= '<li class="previous">' . link_to($previousFile, 'show', __('Previous')) . '</li>';
                }
                if (array_key_exists($originalItemOrder, $originalItemFiles)) {
                    $nextFile = $originalItemFiles[$originalItemOrder];
                    $html .= '<li class="next">' . link_to($nextFile, 'show', __('Next')) . '</li>';
                }
                $html .= '</ul></nav>';
            }
        }

        return $html;
    }
}
?>