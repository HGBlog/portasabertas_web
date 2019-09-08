<?php 
class MinhaBiblioteca_Plugins_Barcode_Barcode extends Zend_Controller_Plugin_Abstract{
	public function create( $value, $options = array(), $barcodetype = 'code39', $type = 'image' ){
		// Somente o texto � obrigat�rio para a cria��o
		$barcodeOptions = array( 'text' => $value );
		// Junta a configura��o padr�o e o $options informado, que s�o os valores de configura��o padr�o do Zend_Barcode
		$barcodeOptions = array_merge( $barcodeOptions, $options );
		// N�o obrigat�rio, para retornar em JPG usa-se: 'imageType' => 'jpg'
		$rendererOptions = array();
		// Para criar uma imagem, faltando s� colocar os headers, o padr�o de imagem � PNG
		return Zend_Barcode::render( $barcodetype, $type, $barcodeOptions, $rendererOptions );
		}
}
?>