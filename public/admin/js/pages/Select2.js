$(document).ready(function() {
    SelectGrupoCurso();
    SelectCategoryPublication();
    SelectTagPublucation();
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
}

function SelectCategoryPublication() {
    $('#type').select2({
        placeholder: "Selecciona la categoria",
    });
}

function SelectTagPublucation() {
    $('#tags').select2({
        placeholder: "Selecciona las etiquetas",
        tags: [],
        language: "es",
        tokenSeparators: [",", " ", ";"],
        maximumSelectionLength: 5
    });
}
