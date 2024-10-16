@extends('layouts.admin')

@section('content')
    <style>
        .table-striped th:nth-child(1),
        .table-striped td:nth-child(1) {
            width: 100px;
        }

        .table-striped th:nth-child(2),
        .table-striped td:nth-child(2) {
            width: 250px;
        }
    </style>
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Pedidos</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="{{ route('admin.index') }}">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Todos los pedidos</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <div class="wg-table table-all-user">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 80px">N° Pedido</th>
                                    <th>Nombre</th>
                                    <th class="text-center">Celular</th>
                                    <th class="text-center">Subtotal</th>
                                    <th class="text-center">IGV</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">Estado</th>
                                    <th class="text-center">Fecha de pedido</th>
                                    <th class="text-center">Artículos totales</th>
                                    <th class="text-center">Entregado el</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td class="text-center">{{ '1' . str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</td>
                                        <td class="text-center">{{ $order->name }}</td>
                                        <td class="text-center">{{ $order->phone }}</td>
                                        <td class="text-center">${{ $order->subtotal }}</td>
                                        <td class="text-center">${{ $order->tax }}</td>
                                        <td class="text-center">${{ $order->total }}</td>
                                        <td class="text-center">
                                            @if ($order->status == 'delivered')
                                                <span class="badge bg-success">Entregado</span>
                                            @elseif($order->status == 'canceled')
                                                <span class="badge bg-danger">Cancelado</span>
                                            @else
                                                <span class="badge bg-warning">Pedido</span>
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $order->created_at }}</td>
                                        <td class="text-center">{{ $order->orderItems->count() }}</td>
                                        <td>{{ $order->delivered_date }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.order.details', ['order_id' => $order->id]) }}">
                                                <div class="list-icon-function view-icon">
                                                    <div class="item eye">
                                                        <i class="icon-eye"></i>
                                                    </div>
                                                </div>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                    {{ $orders->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection
