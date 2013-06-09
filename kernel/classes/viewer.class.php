<?php
/*
Simple template class.
V.0.0.1
#Example of usage:
# index.php
<?php
// lfi protection
define('LFI_PROTECTION', TRUE);
// template class
require ('viewer.class.php');
$view = new viewer();
$view->assign('Hello world!!', 'content');
echo $view->render('example.tpl.php');
?>
# Content of file example.tpl.php:
<?php
echo $this->content;
?>
*/
// Protection from LFI.
// 
if (defined('LFI_PROTECTION'))
{
	// Exception type here
	class viewerException extends Exception {};
	// Template
	class viewer
	{
		// Assign variable to template
		public function assign($value, $prop = 'property')
		{
                    // Acceptable property
                    if (is_string($value) || is_object($value) || is_array($value) || is_integer($value))
                        $this->$prop = $value;
                    else
                    // Trigger error
                        throw new viewerException('Wrong data parsed to view!',1110001);
                    return $this;
		}
		// Render data to template
		public function render($tpl)
		{
                    if (!file_exists($tpl)) 
                        throw new viewerException('Could not render data to view!',1110002);
                    else
                    {
                        ob_start();
                        @(require ($tpl));
                        return ob_get_clean();
                    }   
		}
	}
}
?>