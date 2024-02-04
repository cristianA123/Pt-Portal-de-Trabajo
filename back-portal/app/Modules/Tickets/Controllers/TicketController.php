<?php

namespace App\Modules\Tickets\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Boleta;

use App\Modules\Shared\Traits\Responses;
use App\Modules\Tickets\Contracts\ITicket;
use App\Modules\Tickets\Requests\CreateTicketRequest;
use App\Modules\Tickets\Requests\TicketRequest;

class TicketController extends Controller {

  protected $ITicket;
  use Responses;

  public function __construct(ITicket $ITicket)
  {
      $this->ITicket = $ITicket;
  }



  public function getTickets(TicketRequest $request)
  {
        try {
          $result = $this->ITicket->getTickets();

          if ($result ||  count($result) == 0) {
              return $this->success('tdo', 200, $result);
          } else {
              return $this->failure("No se pudo listar agendas", 404, $request);
          }
      } catch (\Throwable $th) {
          return $this->exception("Error Api get agendas", json_encode($request), $th->getMessage(), "No se pudo listar agendas, Hable con el administrador");
      }
  }

  public function createTicket(CreateTicketRequest $request)
  {

      try {


        $emisor = array(
          "tipo_documento" => 6,
          "ruc" => "20607599727",
          "razon_social" => "INSTITUTO INTERNACIONAL DE SOFTWARE S.A.C.",
          "nombre_comercial" => "ACADEMIA DE SOFTWARE",
          "departamento" => "LAMBAYEQUE",
          "provincia" => "CHICLAYO",
          "distrito" => "CHICLAYO",
          "direccion" => "CALLE OCHO DE OCTUBRE 123",
          "ubigeo" => "140101",
          "usuario_emisor" => "MODDATOS",
          "clave_emisor" => "MODDATOS"
          );

        $cliente = array(
                  "tipo_documento" => "6",
                  "ruc" => "20605145648",
                  "razon_social" => "AGROINVERSIONES Y SERVICIOS AJINOR S.R.L. - AGROSERVIS AJINOR S.R.L.",
                  "direccion" => "MZA. C LOTE. 46 URB. SAN ISIDRO LA LIBERTAD - TRUJILLO - TRUJILLO"
                  );

        $cabecera = array(
                  "tipo_operacion"  => "0101",
                  "tipo_comprobante" => "03",
                  "moneda"          => "PEN",
                  "serie"           => "B001",
                  "correlativo"     => 176,
                  "total_op_gravadas" => 50.17,
                  "igv"          => 9.03,
                  "icbper"       => 0.50,
                  "total_op_exoneradas"=> 140.00,
                  "total_op_inafectas" => 270.00,
                  "total_antes_impuestos" => 460.17,
                  "total_impuestos"    => 9.53,
                  "total_despues_impuestos"=> 469.70,
                  "total_a_pagar"      =>469.70,
                  "fecha_emision"      =>"2023-02-02",
                  "hora_emision"    =>"19:48:00",
                  "fecha_vencimiento" =>"2023-02-02",
                  "forma_pago"      => "Contado",
                  "monto_credito"   => 0.00,
                  "anexo_sucursal"  => "0000" 
                  );

        $cuotas = array();

        $items =array();
   
        $items[] = array(
                 "item"   => 1,
                 "cantidad"   => 1,
                 "unidad"   => "NIU",
                 "nombre" => "MOCHILA",
                 "valor_unitario" => 50.00,          
                 "precio_lista" => 59.00,
                 "valor_total" => 50.00,
                 "igv"  => 9.00,
                 "icbper"  => 0.00,
                 "factor_icbper"   => 0.50, 
                 "total_antes_impuestos" => 50.00,
                 "total_impuestos" => 9.00,
                 "codigos" => array("S","10","1000","IGV","VAT")
                 );
     
        $items[] = array(
                 "item"   => 2,
                 "cantidad"   => 2,
                 "unidad"   => "NIU",
                 "nombre" => "LIBRO COQUITO",
                 "valor_unitario" => 70.00,          
                 "precio_lista" => 70.00,
                 "valor_total" => 140.00,
                 "igv"  => 0.00,
                 "icbper"  => 0.00,
                 "factor_icbper"   => 0.50, 
                 "total_antes_impuestos" => 140.00,
                 "total_impuestos" => 0.00,
                 "codigos" => array("E","20","9997","EXO","VAT")
                 );
     
     
        $items[] = array(
                 "item"   => 3,
                 "cantidad"   => 3,
                 "unidad"   => "NIU",
                 "nombre" => "MANZANA",
                 "valor_unitario" => 90.00,          
                 "precio_lista" => 90.00,
                 "valor_total" => 270.00,
                 "igv"  => 0.00,
                 "icbper"  => 0.00,
                 "factor_icbper"   => 0.50, 
                 "total_antes_impuestos" => 270.00,
                 "total_impuestos" => 0.00,
                 "codigos" => array("O","30","9998","INA","FRE")
                 );
     
     
        $items[] = array(
                 "item"   => 4,
                 "cantidad"   => 1,
                 "unidad"   => "NIU",
                 "nombre" => "BOLSA PLÁSTICA",
                 "valor_unitario" => 0.17,           
                 "precio_lista" => 0.70,
                 "valor_total" => 0.17,
                 "igv"  => 0.03,
                 "icbper"  => 0.50,
                 "factor_icbper"   => 0.50, 
                 "total_antes_impuestos" => 0.17,
                 "total_impuestos" => 0.53,
                 "codigos" => array("S","10","1000","IGV","VAT")
                );



  
        // $result = $this->ITicket->createTicket($request);

        $result = $this->ITicket->createTicket($emisor,$cliente, $cabecera, $cuotas, $items);
        if ($result) {
            return $this->success("Se creó boleta correctamente", 200, $result);
        } else {
            return $this->failure("No se pudo crear Boleta", 404, $request);
        }
      
        } catch (\Throwable $th) {
          return $this->exception("Error Api create Boleta", json_encode($request), $th->getMessage(), "No se pudo crear Boleta, Hable con el administrador");
      }
  }

//   public function updateTicket(Agenda $agenda, UpdateAgendaRequest $request)
  public function updateTicket($agenda, $request)
  {

    //   $this->authorize("authorAgenda", $agenda);

    //   try {

    //       $result = $this->ITicket->updateTicket($agenda, $request);

    //       if ($result) {
    //           return $this->success("Se modificó Agenda correctamente", 200);
    //       } else {
    //           return $this->failure("No se pudo modificar Agenda", 404, $request);
    //       }
    //   } catch (\Throwable $th) {
    //       return $this->exception("Error Api update agenda", json_encode($request), $th->getMessage(), "No se pudo modificar agenda, Hable con el administrador");
    //   }
  }

//   public function deleteTicket( $agenda, DeleteAgendaRequest $request)
  public function deleteTicket( $agenda, $request)
  {
    //   $agenda = Boleta::find($agenda);

    //   $this->authorize("authorAgenda", $agenda);

    //   try {
    //       // $id=$request->agenda_id;
    //       $result = $this->ITicket->deleteTicket($agenda);

    //       if ($result) {
    //           return $this->success("Se elimino agenda correctamente", 200);
    //       } else {
    //           return $this->failure("No se pudo eliminar agenda", 404, $request);
    //       }
    //   } catch (\Throwable $th) {
    //       return $this->exception("Error Api delete agenda", json_encode($request), $th->getMessage(), "No se pudo eliminar agenda, Hable con el administrador");
    //   }
  }

}
