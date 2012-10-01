<?php 
/*
 *******************************************************************************
 *																			   *
 *         DgsGomes - CLASSE PARA GERAR GRAFICOS EM COLUMN STACKED         	   *
 *                AUTOR: DIEGO GOMES DA SILVA		                           *
 *                E-MAIL: diego@diegogomes.net                                 *
 *                        DATA: 13/05/2012                                     *
 * *****************************************************************************
 */
class LineChart /*extends TSWObject*/
{ 
   private $container; 
   private $title; 
   private $subtitle; 
   private $yAxis; 
   private $series; 

     /**
    * Construtor da classe.
    * @param array $conf Array com as configura��es para que o gr�fico funcione.
    * As chaves desse array deve ser iguais aos nomes dos atributos internos dessa classe.
    * Perceba que o �ndice title pode ter mais de um �ndice, equivalentes a t�tulo e subt�tulo respectivamente.
    * @return void
    */
   function __construct($conf) { 
      $this->title      = $conf['title'][0]; 
      $this->subtitle   = $conf['title'][1]; 
      $this->container   = $conf['container']; 
      $this->series      = $conf['series']; 
      $this->yAxis      = $conf['y']; 
   } 

     /**
    * M�todo que gera os dados e os retorna para implementa��o na p�gina.
    * @return string
    */
   function render() { 
      //A linha abaixo foi comentada porque a mesma chama uma outra classe
      //que uso para facilitar a gera��o das minhas tags internas do header
      //da p�gina como tags de chamadas de arquivos CSS <link>
      //de chamadas de arquivos JS ou c�digos JS personalizados sob demanda
      //que nela chamo de LiveScripts. Id�ia para outro artigo!
      //Header::addJSFile("linechart","/js/highcharts/highcharts.js");

      $series = array(); 
      $data = array(); 
      $axis = array(); 
      foreach ( $this->series as $key=>$row ) { 
         $data[$key] = array(); 
         foreach( $row as $_row ) { 
            $axis[] = $_row[0]; 
            $data[$key][] = $_row[1]; 
         } 
      } 
      $axis = "'" . implode("','",$axis) . "'"; 

             foreach( $data as $key=>$row ) { 
         $i = implode(",",$row); 
         $series[] = "{name:'{$key}',data:[{$i}]}"; 
      } 
      $series = implode(",",$series); 

             $str = "chart = new Highcharts.Chart({ 
               chart: { 
                  renderTo: '{$this->container}', 
                  defaultSeriesType: 'pie', 
                  marginRight: 135, 
                  marginBottom: 35 
               }, 
               title: { 
                  text: '{$this->title}', 
                  x: -20 //center 
               }, 
               subtitle: { 
                  text: '{$this->subtitle}', 
                  x: -20 
               }, 
               xAxis: { 
                  categories: [{$axis}] 
               }, 
               yAxis: { 
                  title: { 
                     text: '{$this->yAxis['title']}' 
                  }
               }, 
               tooltip: {
						formatter: function() {
                    return ''+
                        this.series.name +': '+ this.x +'   Total: ' + this.y +' ';
                }

               },
            plotOptions: {
                column: {
                     stacking: 'percent',
                      dataLabels: {
                        enabled: true,
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                    }
                    
                }
            },			   
               legend: { 
                  layout: 'vertical', 
                  align: 'right', 
                  verticalAlign: 'top', 
                  x: -10, 
                  y: 100, 
                  borderWidth: 0 
               }, 
               series: [{$series}],
		exporting:{
		enable:true
		} 
               
            });
            Highcharts.visualize(table, options);   
               
      "; 
      //Lembra que falei do LiveScript?
      //Header::addLiveScript( $str );
      return $str;
   } 
} 
?>