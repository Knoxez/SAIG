$(document).ready(function() {
    TablaGrupo();
    TablaType();
    TablaCurso();
    TablaMetodos();
    TablaComida();
    TablaSponsor();
    TablaTag();
    TablaHorario();
});

function TablaGrupo(){
    $('#tbl_grupo').DataTable({
        language: {"url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"},
        processing: true,
        serverSide: true,
        ajax: {
            url: "listGrupo"
        },
        columns: [
            {data: 'id'},
            {data: 'group_name'},
            {data: null},
        ],
        iDisplayLength: 3,
        aLengthMenu: [[3, 6, 9, -1], [3, 6, 9, "Todos"]],
        aoColumnDefs: [
            {
                "targets": 0,
                "visible": false
            },
            {
                "targets": 2,
                "data": null,
                "width": "25%",
                "orderable": false,
                render: function (data, type, row) {
                    return `<div class="btn-group" role="group" aria-label="Justified button group">
                                <button role="button" class="btn btn-info" onclick="GrupoEdit(this)" id="`+row['id']+`"><span class="icon-pencil"></span></button>
                                <button role="button" class="btn btn-danger btn-grp-delete"  id="`+row['id']+`"><span class="icon-trash"></span></button>
                            </div>`;
                }
            }
        ],
        fixedColumns: true,
        rowId: "id",
    });
}

function TablaType(){
    $('#tbl_type').DataTable({
        language: {"url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"},
        processing: true,
        serverSide: true,
        ajax: {
            url: "listType"
        },
        columns: [
            {data: 'id'},
            {data: 'type_name'},
            {data: null},
        ],
        iDisplayLength: 3,
        aLengthMenu: [[3, 6, 9, -1], [3, 6, 9, "Todos"]],
        aoColumnDefs: [
            {
                "targets": 0,
                "visible": false
            },
            {
                "targets": 2,
                "data": null,
                "width": "25%",
                "orderable": false,
                render: function (data, type, row) {
                    return `<div class="btn-group" role="group" aria-label="Justified button group">
                                <button role="button" class="btn btn-info btn-type-edit" id="`+row['id']+`"><span class="icon-pencil"></span></button>
                                <button role="button" class="btn btn-danger btn-type-delete"  id="`+row['id']+`"><span class="icon-trash"></span></button>
                            </div>`;
                }
            }
        ],
        fixedColumns: true,
        rowId: "id",
    });
}

function TablaCurso() {
    $('#tbl_cursos').DataTable({
        language: {"url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"},
        processing: true,
        serverSide: true,
        ajax: {
            url: "listCurso"
        },
        columns: [
            {data: 'id'},
            {data: 'course_name'},
            {data: 'hours'},
            {data: 'description'},
            {data: null},
        ],
        iDisplayLength: 5,
        aLengthMenu: [[5, 10, 15, -1], [5, 10, 15, "Todos"]],
        aoColumnDefs: [
            {
                "targets": 0,
                "visible": false
            },
            {
                "targets": 3,
                "width": "55%",
                render: function (data, type, row){
                    return type === 'display' && data.length > 125 ?
                        data.substr( 0, 125) + '...' :
                        data;
                }
            },
            {
                "targets": 4,
                "data": null,
                "width": "10%",
                "orderable": false,
                render: function (data, type, row) {
                    return `<div class="btn-group" role="group" aria-label="Justified button group">
                                <button role="button" class="btn btn-info btn-curso-edit" id="`+row['id']+`"><span class="icon-pencil"></span></button>
                                <button role="button" class="btn btn-danger btn-curso-delete"  id="`+row['id']+`"><span class="icon-trash"></span></button>
                            </div>`;
                }
            }
        ],
        fixedColumns: true,
        rowId: "id",
    });
}

function TablaMetodos() {
    $('#tbl_metodos').DataTable({
        language: {"url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"},
        processing: true,
        serverSide: true,
        ajax: {
            url: "listMethod"
        },
        columns: [
            {data: 'id'},
            {data: 'method_name'},
            {data: 'content'},
            {data: null},
        ],
        iDisplayLength: 5,
        aLengthMenu: [[5, 10, 15, -1], [5, 10, 15, "Todos"]],
        aoColumnDefs: [
            {
                "targets": 0,
                "visible": false
            },
            {
                "targets": 2,
                "width": "55%",
                render: function (data, type, row){
                    return type === 'display' && data.length > 125 ?
                        data.substr( 0, 125) + '...' :
                        data;
                }
            },
            {
                "targets": 3,
                "data": null,
                "width": "10%",
                "orderable": false,
                render: function (data, type, row) {
                    return `<div class="btn-group" role="group" aria-label="Justified button group">
                                <button role="button" class="btn btn-info btn-metodo-edit" id="`+row['id']+`"><span class="icon-pencil"></span></button>
                                <button role="button" class="btn btn-danger btn-metodo-delete"  id="`+row['id']+`"><span class="icon-trash"></span></button>
                            </div>`;
                }
            }
        ],
        fixedColumns: true,
        rowId: "id",
    });
}

function TablaComida() {
    $('#tbl_comida').DataTable({
        language: {"url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"},
        processing: true,
        serverSide: true,
        ajax: {
            url: "listComida"
        },
        columns: [
            {data: 'id'},
            {data: 'title'},
            {data: 'fecha_ini'},
            {data: 'fecha_fin'},
            {data: null},
        ],
        iDisplayLength: 5,
        aLengthMenu: [[5, 10, 15, -1], [5, 10, 15, "Todos"]],
        aoColumnDefs: [
            {
                "targets": 0,
                "visible": false
            },
            {
                "targets": 4,
                "data": null,
                "width": "15%",
                "orderable": false,
                render: function (data, type, row) {
                    return `<div class="btn-group" role="group" aria-label="Justified button group">
                                <button role="button" class="btn btn-info btn-comida-edit" id="`+row['id']+`"><span class="icon-pencil"></span></button>
                                <button role="button" class="btn btn-danger btn-comida-delete"  id="`+row['id']+`"><span class="icon-trash"></span></button>
                                <button role="button" class="btn btn-warning btn-comida-pdf" id="`+row['id']+`"><span class="fa fa-file-pdf-o"></span></button>
                            </div>`;
                }
            }
        ],
        fixedColumns: true,
        rowId: "id",
    });
}

function TablaSponsor() {
    $('#tbl_sponsor').DataTable({
        language: {"url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"},
        processing: true,
        serverSide: true,
        ajax: {
            url: "listSponsor"
        },
        columns: [
            {data: 'id'},
            {data: 'sponsor_name'},
            {data: null},
        ],
        iDisplayLength: 3,
        aLengthMenu: [[3,6,9,-1], [3,6,9,"Todos"]],
        aoColumnDefs: [
            {
                "targets": 0,
                "visible": false
            },
            {
                "targets": 2,
                "data":  null,
                "width": "10%",
                "orderable": false,
                render: function (data, type, row) {
                    return `<div class="btn-group" role="group" aria-label="Justified button group">
                                <button role="button" class="btn btn-info btn-sponsor-edit" id="`+row['id']+`"><span class="icon-pencil"></span></button>
                                <button role="button" class="btn btn-danger btn-sponsor-delete"  id="`+row['id']+`"><span class="icon-trash"></span></button>
                            </div>`;
                }
            }
        ],
        fixedColumns: true,
        rowId: "id",
    });
}

function TablaTag() {
    $('#tbl_tag').DataTable({
        language: {"url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"},
        processing: true,
        serverSide: true,
        ajax: {
            url: "listTag"
        },
        columns: [
            {data: 'id'},
            {data: 'tag_name'},
            {data: null},
        ],
        iDisplayLength: 3,
        aLengthMenu: [[3,6,9,-1], [3,6,9,"Todos"]],
        aoColumnDefs: [
            {
                "targets": 0,
                "visible": false
            },
            {
                "targets": 2,
                "data":  null,
                "width": "25%",
                "orderable": false,
                render: function (data, type, row) {
                    return `<div class="btn-group" role="group" aria-label="Justified button group">
                                <button role="button" class="btn btn-info btn-tag-edit" id="`+row['id']+`"><span class="icon-pencil"></span></button>
                                <button role="button" class="btn btn-danger btn-tag-delete"  id="`+row['id']+`"><span class="icon-trash"></span></button>
                            </div>`;
                }
            }
        ],
        fixedColumns: true,
        rowId: "id",
    });
}

function TablaHorario() {
    $('#tbl_horarios').DataTable({
        language: {"url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"},
        processing: true,
        serverSide: true,
        ajax: {
            url: "listHorario"
        },
        columns: [
            {data: 'id'},
            {data: 'schedule_name'},
            {data: 'file'},
            {data: 'grupo'},
            {data: null},
        ],
        iDisplayLength: 5,
        aLengthMenu: [[5,10,15,-1], [5,10,15,"Todos"]],
        aoColumnDefs: [
            {
                "targets": 0,
                "visible": false
            },
            {
                "targets": 4,
                "data":  null,
                "width": "15%",
                "orderable": false,
                render: function (data, type, row) {
                    return `<div class="btn-group" role="group" aria-label="Justified button group">
                                <button role="button" class="btn btn-info btn-horario-edit" id="`+row['id']+`"><span class="icon-pencil"></span></button>
                                <button role="button" class="btn btn-danger btn-horario-delete"  id="`+row['id']+`"><span class="icon-trash"></span></button>
                                <button role="button" class="btn btn-warning btn-horario-download" id="`+row['id']+`"><span class="icon-cloud-download"></span></button>
                            </div>`;
                }
            }
        ],
        fixedColumns: true,
        rowId: "id",
    });
}
