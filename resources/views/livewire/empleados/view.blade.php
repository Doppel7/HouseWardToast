@section('title', __('Empleados'))
<div class="container-fluid">
	<br>
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
			@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fab fa-laravel text-info"></i>
							Empleados </h4>
						</div>
						<div wire:poll.60s>
							<code><h5>{{ now()->format('H:i:s') }}</h5></code>
						</div>
						
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar Empleado">
						</div>
						<div class="btn btn-sm btn-info" data-toggle="modal" data-target="#createDataModal">
						<i class="fa fa-plus"></i>  Agregar Empleado
						</div>
					</div>
				</div>
				
				<div class="card-body">
						@include('livewire.empleados.create')
						@include('livewire.empleados.update')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr> 
								<td>#</td> 
								<th>Tipo de documento</th>
								<th>Documento</th>
								<th>Nombre</th>
								<th>Email</th>
								<th>Dirección</th>
								<th>Municipio</th>
								<th>Fecha de nacimiento</th>
								<th>Teléfono</th>
								<th>Celular</th>
								<th>Estado</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach($empleados as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								@foreach($tipodocumentos as $tipodocumento)
								@if($row->tipodoc_id==$tipodocumento->id)
								<td>{{ $tipodocumento->nombre}}</td>
								@break;
								@endif
								@endforeach
								<td>{{ $row->documento }}</td>
								<td>{{ $row->nombre }}</td>
								<td>{{ $row->email }}</td>
								<td>{{ $row->direccion }}</td>
								@foreach($municipios as $municipio)
								@if($row->municipio==$municipio->id)
								<td>{{ $municipio->nombre}}</td>
								@break;
								@endif
								@endforeach
								<td>{{ $row->fechadenacimiento }}</td>
								<td>{{ $row->telefono }}</td>
								<td>{{ $row->celular }}</td>
								<td>
									@if($row->estado==1)
									<p style="color:green"><strong>Activo</strong></p>
									@else
                                    <p style="color:red"><strong>Inactivo</strong></p>
									@endif
								</td>
								<td width="90">
								<div class="btn-group">
									<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Acciones
									</button>
									<div class="dropdown-menu dropdown-menu-right">
									<a data-toggle="modal" data-target="#updateModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Editar </a>							 
									
									</div>
								</div>
								</td>
							@endforeach
						</tbody>
					</table>						
					{{ $empleados->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
