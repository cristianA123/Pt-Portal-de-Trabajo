<?php

namespace App\Modules\Tickets\Contracts;

interface ITicket {
  public function getTickets();
  public function createTicket($emisor,$cliente, $cabecera, $cuotas, $items);
  // public function createTicket($data);
  public function updateTicket($id, $data);
  public function deleteTicket($id);
}