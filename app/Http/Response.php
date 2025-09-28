<?php

namespace App\Http;

class Response
{    
    /**
     * Código do Status HTTP
     *
     * @var integer
     */
    private $httpCode = 200;
    
    /**
     * Cabeçalho do response
     *
     * @var array
     */
    private $headers = [];
    
    /**
     * Tipo de conteúdo que está sendo retornado
     *
     * @var string
     */
    private $contentType = 'text/html';
    
    /**
     * Conteúdo do Repsonse
     *
     * @var mixed
     */
    private $content;
    
    /**
     * Método responsável por iniciar e classe e definir os valores
     *
     * @param  integer $httpCode
     * @param  mixed   $content
     * @param  string  $contentType
     */
    public function __construct($httpCode, $content, $contentType = 'text/html')
    {
        $this->httpCode    = $httpCode;
        $this->content     = $content;
        $this->setContentType($contentType);
    }
    
    /**
     * Método responsável por alterar o content type do response
     *
     * @param  string $contentType
     * @return void
     */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
        $this->addHeader('Content-Type', $contentType);
    }
    
    /**
     * Método responsável por adicionar um registro ao cabeçalho de response
     *
     * @param  string $key
     * @param  string $value
     */
    public function addHeader($key, $value)
    {
        $this->headers[$key] = $value;
    }
    
    /**
     * Método responsável por enviar os headers para o navegador
     *
     * @return void
     */
    private function sendHeaders()
    {
        /* Status */
        http_response_code($this->httpCode);

        /* Enviar Headers */
        foreach($this->headers as $key => $value){
            header($key. ': ' . $value);
        }
    }
    
    /**
     * Método responsável por enviar a resposta para o usuário
     *
     * @return void
     */
    public function sendResponse()
    {
        /* Envia os Headers */
        $this->sendHeaders();

        /* Imprime o conteúdo */
        switch($this->contentType){
            case 'text/html':
                echo $this->content;
                break;
        }
    }
}