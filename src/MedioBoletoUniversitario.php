<?php

namespace TrabajoTarjeta;

class MedioBoletoUniversitario extends Tarjeta {

    protected $viajesDiarios = 0;

    protected $diaAnterior = NULL;

    public function __construct($tiempo) {
        $this->precio = ( (new Tarjeta())->precio ) / 2;
        $this->tiempo = $tiempo;
    }

    public function puedePagar(){
        $this->cambioDeDia();
        $actual = $this->tiempo->time();
        $diferencia = $actual - ($this->anteriorTiempo);
        if($this->viajesDiarios>=2){
            $this->precio = (new Tarjeta())->precio;
        }else{
            $this->precio = ((new Tarjeta())->precio) / 2;
        }
        if( ($diferencia>=300) || $this->anteriorTiempo === NULL) {
            $resultado = parent::puedePagar();
            if($resultado != "no"){
                $this->anteriorTiempo = $actual;
                $this->viajesDiarios++;
            }
            return $resultado;
        }
        return "no";
    }

    public function cambioDeDia() {
        if($this->diaAnterior!=NULL) {
            if( (($this->tiempo->time()) - ($this->diaAnterior)) >= (3600*24) ){
                $this->viajesDiarios = 0;
                $this->diaAnterior = $this->tiempo->time();
            }
        }
        else{
            $this->diaAnterior=$this->tiempo->time();
        }
    }
}