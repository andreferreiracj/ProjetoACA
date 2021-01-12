<?php
class film {
    //ATRIBUTOS
    public  $title;
    public  $description;
    public  $genre;
    public  $director;
    
    

    //========================GETS E SETS==============================
    //get e set do titulo
    function setTitle( $title) {
        $this->title = $title;
      }
      function getTitle() {
        return $this->title;
      }

      //get e set da descrição
      function setDescription($description) {
        $this->description = $description;
      }
      function getDescription() {
        return $this->description;
      }

      //get e set do director
      function setDirector($director) {
        $this->director = $director;
      }
      function getDirector() {
        return $this->director;
      }
     
      

      //=====================Construtores================================
      function __construct($title,$description,$genre,$director) {
        $this->title = $title;
        $this->description = $description;
        $this->genre = $genre;
        $this->director = $director;
       
      }
    
      //output
      public function __toString(){
        return  
        ' =================Movie================= ' ."\r\n".
        ' Title: ' . $this->title  . "\r\n" . 
        ' Description: ' . $this->description  . "\r\n" .
        ' Genre: ' . $this->genre . "\r\n" .
        ' Director: ' . $this->director;
       

       
    }
     
}
