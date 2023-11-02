
$.getScript("https://code.jquery.com/jquery-3.6.0.min.js", function() {
    $(document).ready(function() {
        $('input[type="checkbox"]').on('change', function() {
            console.log("Checkbox clicked");
            var isChecked = $(this).is(':checked');
            var id = $(this).closest('tr').find('input[name="id"]').val();
            
            $.ajax({
                url: '../processaTarefas.php',
                method: 'POST',
                data: { id: id, status: isChecked ? 1 : 0, acao: 2 },
                success: function(response) {
                    console.log("Requisição bem-sucedida!");
                    console.log(response); // Imprime a resposta do servidor
                },
                error: function(xhr, status, error) {
                    console.error("Erro na requisição AJAX:");
                    console.error(error);
                }
            });
        });
    });
}).fail(function(jqxhr, settings, exception) {
    console.error("Não foi possível carregar o jQuery:", exception);
});


function showEdit() {
    var section = document.getElementById("#editTask");
    var sectionForm = window.getComputedStyle(section).getPropertyValue("display");
    if (sectionForm === "none") {
        section.style.display = "flex";
    } else {
        section.style.display = "none";
    }
}
