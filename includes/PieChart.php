<?php 
/**
* PieChart
* Classe que implementa a abstração de gráficos highcharts.com para
* gráfico tipo pizza.
*
* @author Evaldo Barbosa <tryadesoftware@gmail.com>
*/
class LineChart /*extends TSWObject*/{ 
    
   private $container; 
   private $title; 
   private $subtitle; 

      /**
    * Construtor da classe.
    * @param array $conf Array com as configurações para que o gráfico funcione.
    * As chaves desse array deve ser iguais aos nomes dos atributos internos dessa classe.
    * Perceba que o índice title pode ter mais de um índice, equivalentes a título e subtítulo respectivamente.
    * @return void
    */
   function __construct($conf) { 
      $this->title      = $conf['title'][0]; 
      $this->subtitle   = $conf['title'][1]; 
      $this->container   = $conf['container']; 
      $this->series      = $conf['series']; 
   } 

      /**
    * Método que gera os dados e os retorna para implementação na página.
    * @return string
    */
   function render() { 
      $series = array(); 
      foreach ( $this->series as $row ) { 
         $row[1] = sprintf("%01.2f",$row[1]); 
         $series[] = "['{$row[0]}',{$row[1]}]"; 
      } 
      $series = implode(",",$series); 

             //Header::addJSFile("piechart","/js/highcharts/highcharts.js");
      $str = "chart = new Highcharts.Chart({ 
               chart: { 
                  renderTo: '{$this->container}', 
                  plotBackgroundColor: null, 
                  plotBorderWidth: null, 
                  plotShadow: false 
               }, 
               title: { 
                  text: '{$this->title}' 
               }, 
               tooltip: { 
                  formatter: function() { 
                     return '<b>'+ this.point.name +'</b> <br /> Total : '+ this.y +' <br />  Porcentagem: ('+ Math.round(this.percentage) +'%)'; 
                  } 
               }, 
               plotOptions: { 
                  pie: { 
                     allowPointSelect: true, 
                     cursor: 'pointer', 
                     dataLabels: { 
                        enabled: false 
                     }, 
                     showInLegend: true 
                  } 
               }, 
                series: [{ 
                  type: 'pie', 
                  name: '{$this->subtitle}', 
                  data: [{$series}] 
               }] 
            });"; 
      //Lembra que falei do LiveScript?
      //Header::addLiveScript( $str );
      return $str; 
   } 
} 
?>