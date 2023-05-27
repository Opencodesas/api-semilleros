<table>
    <thead>
        <tr>
            <th style="width: 30px;text-align:center">
                <b>#</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>NOMBRE</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>EMAIL</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>DIRECCIÓN</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>GENERO</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>NÚMERO DE DOCUMENTO DE IDENTIFICACIÓN</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>TIPO DE DOCUMENTO</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>ROL</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>REGIONES</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>DISCIPLINAS</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>ÚLTIMA FECHA DE ACCESO</b>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $key => $user)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $user->name . ' ' . $user->lastname }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->address }}</td>
                <td>{{ $user->gender }}</td>
                <td>{{ $user->document_number }}</td>
                <td>{{ $user->document_type }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->rol }}</td>
                <td>{{ $user->region }}</td>
                <td>{{ $user->discipline }}</td>
                <td>{{ $user->end_date }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
