<table>
    <thead>
        <tr>
            <th style="width: 30px;text-align:center">
                <b>#</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>NOMBRE MONITOR</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>CEDULA MONITOR</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>FECHA DE CREACIÓN</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>MUNICIPIO</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>REGIÓN</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>DISCIPLINAS</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>FECHA DE NACIMIENTO</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>LUGAR DE NACIMIENTO</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>EDAD</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>TIPO DE IDENTIFICACIÓN</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b># IDENTIFICACIÓN</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>DIRECCIÓN</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b># TELÉFONO/CELULAR</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>ESTRATO</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>ZONA</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>VÍCTIMA DE CONFLICTO</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>GENERO</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>ETNIA</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>DISCAPACIDAD</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>TIPO DE DISCAPACIDAD</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>PATOLOGÍA</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>TIPO DE PATOLOGÍA</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>RH</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>ESCOLARIDAD</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>NIVEL ESCOLARIDAD</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>INSTITUCIÓN</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>VIVE</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>EPS Afiliación</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>TIPO AFILIACIÓN</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>NOMBRES Y APELLIDOS(ACUDIENTE)</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b># CEDULA</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>PARENTESCO</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>EMAIL</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>CELULAR</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>REDES SOCIALES</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>CONOCIMIENTO DEL PROYECTO</b>
            </th>
            <th style="width: 30px;text-align:center">
                <b>ESTADO</b>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($inscriptions as $key => $value)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $value->monitor_name . ' ' . $value->monitor_lastname }}</td>
                <td>{{ $value->moni_document_number }}</td>
                <td>{{ $value->created_at }}</td>
                <td>{{ $value->municipalitie }}</td>
                <td>{{ $value->zone }}</td>
                <td>{{ $value->discipline }}</td>
                <td>{{ $value->birth_date }}</td>
                <td>{{ $value->origin_place }}</td>
                <td>{{ $value->edad }}</td>
                <td>{{ $value->type_document }}</td>
                <td>{{ $value->guardian_document_number }}</td>
                <td>{{ $value->home_address }}</td>
                <td>{{ $value->phone }}</td>
                <td>{{ $value->stratum }}</td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->conflict_victim }}</td>
                <td>{{ $value->gender }}</td>
                <td>{{ $value->etnia }}</td>
                <td>{{ $value->disability }}</td>
                <td>{{ $value->other_disability }}</td>
                <td>{{ $value->pathology }}</td>
                <td>{{ $value->what_pathology }}</td>
                <td>{{ $value->blood_type }}</td>
                <td>{{ $value->scholarship }}</td>
                <td>{{ $value->scholar_level }}</td>
                <td>{{ $value->institution }}</td>
                <td>{{ $value->live_with }}</td>
                <td>{{ $value->affiliation }}</td>
                <td>{{ $value->affiliation_type }}</td>
                <td>{{ $value->name_guardian.''.$value->lastname_guardian }}</td>
                <td>{{ $value->cedula }}</td>
                <td>{{ $value->relationship }}</td>
                <td>{{ $value->email }}</td>
                <td>{{ $value->phone_number }}</td>
                <td>{{ $value->social_media }}</td>
                <td>{{ $value->find_out }}</td>
                <td>{{ $value->status }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
