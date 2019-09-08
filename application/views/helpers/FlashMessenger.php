<?php
class Zend_View_Helper_FlashMessenger extends Zend_View_Helper_Abstract
{
    /**
     * @var Zend_Controller_Action_Helper_FlashMessenger
     */
    private $_flashMessenger = null;

    /**
     * Display Flash Messages.
     *
     * @param  string $key Message level for string messages
     * @param  string $template Format string for message output
     * @return string Flash messages formatted for output
     */
    public function flashMessenger($key = 'alert',
                                   $template='<p class="%s">%s</p>')
    {
        $flashMessenger = $this->_getFlashMessenger();
        //get messages from previous requests
        $messages = $flashMessenger->getMessages();

        //add any messages from this request
        if ($flashMessenger->hasCurrentMessages()) {
            $messages = array_merge(
                $messages,
                $flashMessenger->getCurrentMessages()
            );
            //we don't need to display them twice.
            $flashMessenger->clearCurrentMessages();
        }

        //initialise return string
        $output ='';
        //process messages
        foreach ($messages as $message){
            if (is_array($message))
                list($key,$message) = each($message);
            switch($key){
                case 'notice':
                    $output .= '<div class="alert-box notice"><span>Informação: </span>' . $message . '</div>';
                break;
                case 'error':
                    $output .= '<div class="alert-box error"><span>Erro: </span>' . $message . '</div>';
                    break;
                case 'success':
                    $output .= '<div class="alert-box success"><span>Sucesso: </span>' . $message . '</div>';
                    break;
                case 'warning':
                    $output .= '<div class="alert-box warning"><span>Alterta: </span>' . $message . '</div>';
                    break;
                default:
                    $output .= sprintf($template,$key,$message);
            }
        }

        return $output;
    }

    /**
     * Lazily fetches FlashMessenger Instance.
     *
     * @return Zend_Controller_Action_Helper_FlashMessenger
     */
    public function _getFlashMessenger()
    {
        if (null === $this->_flashMessenger) {
            $this->_flashMessenger =
                Zend_Controller_Action_HelperBroker::getStaticHelper(
                    'FlashMessenger');
        }
        return $this->_flashMessenger;
    }
}