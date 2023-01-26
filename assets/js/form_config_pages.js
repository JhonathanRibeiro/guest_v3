$('#form').submit(function(e){
    console.log('Carregou script');
    e.preventDefault();

    var ck_consultar = $('.ck_consultar').val();
    var ck_incluir = $('.ck_incluir').val();
    var ck_editar = $('.ck_editar').val();
    var ck_excluir = $('.ck_excluir').val();

    console.log(`ck_consultar: ${ck_consultar}`);
    console.log(`ck_incluir: ${ck_incluir}`);
    console.log(`ck_editar: ${ck_editar}`);
    console.log(`ck_excluir: ${ck_excluir}`);

    $.ajax({
        url: 'http://localhost/gestao_v3/modules/manutencao_preventiva/nivel_acesso/crud/cad_permissao_telas.php',
        method: 'POST',
        // data: {
        //     consultar: ck_consultar,
        //     incluir: ck_incluir,
        //     editar: ck_editar,
        //     excluir: ck_excluir
        // },
        data: {
         consultar: [
            {
                tela_id: 1,
                ck_cons: 1,
            },
            {
                tela_id: 2,
                ck_cons: 0
            }
        ]
        },
        dataType: 'json'
    }).done(function(res){
        console.log(res);
    });
});

