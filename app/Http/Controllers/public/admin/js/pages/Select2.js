$(document).ready(function() {
    SelectGrupoCurso();
});

function SelectGrupoCurso() {
    $('#group').select2({
        placeholder: "Selecciona los grupos",
        ajax: {
            url: 'selectGrupo',
            dataType: 'json',
            data: function (params){
                return {
                    term: params.term
                }
            },
            processResults: function(data, page){
                return {
                    results: data
                };
            },
        }
    });

    $('.select2-search__field').css('width', '100%');
    $('.select2-search--inline').css('width', '100%');
}
