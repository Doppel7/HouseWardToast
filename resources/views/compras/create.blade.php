@extends('dash.index')
@section('content')
<br>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('compras.store')}}" method="post" class="form-horizontal">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
							<h4><i class="fab fa-laravel text-info"></i>
							Compras</h4>
					    </div>
                            <div wire:poll.60s>
							<code><h5>{{ now()->format('H:i:s') }} </h5></code>
						    </div>
                        </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 grid-margin">
                                    <div class="card">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="card-body">
                                                <div class="form-group">
                                    <label for="proveedor_id"></label>
                                    <select class="form-control" name="proveedor_id" id="proveedor_id">
                                        <option value="">Seleccione el proveedor</option>
                                        @foreach ( $proveedores as $row )
                                        @if ($row->estado==0)
                                        @continue
                                        @endif
                                        <option value="{{$row->id}}">{{$row->nombre}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('proveedor_id'))
                                    <span class="error text-danger" for="input-proveedor_id">{{ $errors->first('proveedor_id') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                                <label for="fecha">Fecha de Compra</label>
                                                <input type="date" class="form-control" name="fecha" placeholder="Ingrese la fecha" value="{{old('fecha')}}" autofocus>
                                                @if ($errors->has('fecha'))
                                                <span class="error text-danger" for="input-fecha">{{ $errors->first('fecha') }}</span>
                                                @endif
                                                </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                            <div class="card-body">
                                            <div class="form-group">
                                                <label for="factura"></label>
                                                <input type="text" class="form-control" name="factura" placeholder="Ingrese numero de factura" value="{{old('factura')}}" autofocus>
                                                @if ($errors->has('factura'))
                                                <span class="error text-danger" for="input-factura">{{ $errors->first('factura') }}</span>
                                                @endif
                                                </div>
                                                <div class="form-group">
                                                <label for="total">Total</label>
                                                <input type="number" class="form-control" id="total" name="total" readonly></div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">   
                            <div class="col-12 text-center">
                                <a href="{{route('compras.create')}}" class="btn btn-primary" data-toggle="modal" data-target="#Form">Agregar Insumo</a>
                            </div>
                            <br>
                        <div class="table-responsive">
                            <table  id="Compras" table id="compras" class="table table-bordered table-sm">
                                <thead class="thead">
                                <tr>
                                    <th>Insumo</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Sub Total</th>
                                    <th>Funciones</th>
                                </tr>
                                </thead>
                                <tbody id="tblInsumos">

                                </tbody>
                            </table>
                        </div>
                        <div class="text-center">
                            <a href="{{route('compras.index')}}" class="btn btn-secondary close-btn">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

                        <div wire:ignore.self class="modal fade" id="Form" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="createDataModalLabel">Agregar Insumo</h5>
                                    <button type="button" wire:click.prevent="cancel()" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true close-btn">×</span>
                                    </button>
                                </div>
                            <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label for="insumo"></label>
                                    <select class="form-control " name="insumo" id="insumo" required>
                                        <option value="">Seleccione el insumo</option>
                                        @foreach ( $insumos as $row )
                                        @if ($row->estado==0)
                                        @continue
                                        @endif
                                        <option value="{{$row->id}}">{{$row->nombre}}</option>
                                        @endforeach
                                    </select>
                                        @if ($errors->has('insumo'))
                                        <span class="error text-danger" for="input-insumo">{{ $errors->first('insumo') }}</span>
                                        @endif
                                </div>
                                <div class="form-group">
                                        <label for="cantidad"></label>
                                        <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="Ingrese cantidad comprada" required>
                                        @if ($errors->has('cantidad'))
                                        <span class="error text-danger" for="input-cantidad">{{ $errors->first('cantidad') }}</span>
                                        @endif
                                </div>
                                <div class="form-group">
                                        <label for="precio"></label>
                                        <input type="number" class="form-control" id="precio" name="precio" placeholder="Ingrese precio" required>
                                        @if ($errors->has('precio'))
                                        <span class="error text-danger" for="input-precio">{{ $errors->first('precio') }}</span>
                                        @endif
                                </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" onclick="agregar_insumo()" data-dismiss="modal" class="btn btn-primary close-modal">Agregar Insumo</button>
                                </div>
                            </form>
                            </div>
                            </div>
                        </div>
<script>
            
            


            function agregar_insumo(){
                let insumo_id = $("#insumo option:selected").val();
                let insumo_text = $("#insumo option:selected").text();
                let cantidad = $("#cantidad").val();
                let precio = $("#precio").val();

                if(insumo_id>0 &&cantidad > 0 && precio > 0){
                    $("#tblInsumos").append(`
                        <tr id="tr-${insumo_id}">

                            <td>
                                <input type="hidden" name="insumo_id[]" value="${insumo_id}" />
                                <input type="hidden" name="cantidades[]" value="${cantidad}" />
                                <input type="hidden" name="precios[]" value="${precio}" />
                                ${insumo_text}

                            </td>
                            <td>${cantidad}</td>
                            <td>${precio}</td>
                            <td>${parseInt(precio) * parseInt(cantidad)}</td>
                            <td>
                                <button type="button" class="btn btn-danger" onclick="eliminar_insumo(${insumo_id}, ${parseInt(cantidad) * parseInt(precio)})" >X</button>
                            </td>

                        </tr>
                    `);
                        let total = $("#total").val() || 0;
                        $("#total").val(parseInt(total) + parseInt(cantidad) * parseInt(precio));
                }
                else {
                    alert("Se debe ingresar una cantidad y/o precio valido");
                }
                $("#insumo").val('');
                $("#cantidad").val('');
                $("#precio").val('');




            }

            function eliminar_insumo(id,subtotal){
                $("#tr-"+id).remove("");
  
                let total = $("#total").val() || 0;
             $("#total").val(parseInt(total) - subtotal);


            }
        </script>
@endsection


        


