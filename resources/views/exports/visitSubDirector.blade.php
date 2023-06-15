<table>
    <thead>
        <tr>
            <th style="width: 30px;text-align:center">
                <b>#</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>SUBDIRECTOR</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>FECHA</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>HORA</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>MUNICIPIO</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>ESCENARIO DEPORTIVO</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>MONITOR</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>DISCIPLINA</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>APOYA EL EVENTO</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>EVENTO</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>COBERTURA DEL BENEFICIARIO</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>CUMPLE CON EL DESARROLLO DEL COMPONENTE TECNICO DEL MES</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>ESTADO</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>FECHA CREACION</b>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($visitSubDirector as $key => $value)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $value->creator_name . ' ' . $value->creator_lastname }}</td>
                <td>{{ $value->date_visit }}</td>
                <td>{{ $value->hour_visit }}</td>
                <td>{{ $value->municipalitie }}</td>
                <td>{{ $value->sports_scene }}</td>
                <td>{{ $value->monitor_name . ' ' . $value->monitor_lastname }}</td>
                <td>{{ $value->discipline }}</td>
                <td>{{ $value->event_support }}</td>
                <td>{{ $value->description }}</td>
                <td>{{ $value->beneficiary_coverage }}</td>
                <td>{{ $value->technical }}</td>
                <td>{{ $value->status }}</td>
                <td>{{ $value->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
