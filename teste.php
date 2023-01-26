<form id="form">
<table class="table table-striped">
    <tr>
        <th>#</th>
        <th>Tela</th>
        <th>Consultar</th>
        <th>Incluir</th>
        <th>Editar</th>
        <th>Excluir</th>
    </tr>
    <tr>
        <td class="id">1</td>
        <td class="nome">Tela1</td>
        <td><input type="checkbox" class="ck_consultar" name="dados[cons]" value="1"></td>
        <td><input type="checkbox" class="ck_incluir" name="dados[inc]" value="1"></td>
        <td>
            <input type="checkbox" class="ck_editar" name="dados[edit]" value="1">
        </td>
        <td>
            <input type="checkbox" class="ck_excluir" name="dados[exc]" value="1">
        </td>
    </tr>
</table>
<input type="submit" value="Salvar">
</form>

<script src="assets/js/jquery-3.6.3.min.js"></script>

<script type="text/javascript">
$('#form').submit(function(e){
    console.log('Carregou script');
    e.preventDefault();
    var id_tela = $('.id');
    var nome = $('.nome');
    var consultar = $('.ck_consultar');
    var incluir = $('.ck_incluir');
    var editar = $('.ck_editar');
    var excluir = $('.ck_excluir');
    //Array final que vai ser enviado por AJAX
    var array = [];

    //Monta o array
    for(var i = 0; i < 6; i++) {
    array[i] = [id_tela[i] = id_tela.val(), nome[0] = nome.val(), consultar[1] = consultar.val(), incluir[2] = incluir.val()], editar[3] = editar.val(), excluir[4] = excluir.val();
    }
    console.log(array);
    // //Chama o AJAX
    // $.ajax({
    // url: 'http://localhost/gestao_v3/teste.php',
    // type: 'post',
    // data: {array: array}
    // })
    // .done(function(result) {
    //     console.log(result);
    // });
});
</script>
