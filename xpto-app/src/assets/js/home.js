$(document).ready(function() {
    
    /** Carregando o grid de dados */
    var linhas = $('table tbody#dados');
    var dados = [];
    var status = [];
    var view;
    var excluir;
    var service;
    var company;
    
    // Modal de mensagem
    $("#message").modal("show");

    $.ajax({

        url: BASE_URL + '/home/getMovements',
        type: 'get',
        dataType: 'json',
        success: function(json){
            
            dados   = json.dados;
            status  = json.status;
            view    = json.view;
            excluir = json.excluir;
            service = json.tpservice;
            company = json.company;
            retriveDataSet();
        }
    });

    function retriveDataSet() {
        var html                = "";
        var btn_analisa         = "";
        var btn_excluir         = "";
        var dataGrupo           = $.getJSON();
        var statusName          = "";
        var nameService         = "";
        var valueService        = "";
        var company_name        = "";

        dados.forEach(element => {     
            
            if (view == true && element.status_id == '1')
            {
                for (let ind = 0; ind < company.length; ind++) {
                  if (company[ind].id == element.company_id) {
                        company_name = company[ind].name;
                        break;
                  }
                }

                for (let i = 0; i < service.length; i++) {
                    
                    if (service[i].id == element.service_id) {
                        nameService = service[i].description;
                        valueService = service[i].value_service;
                        break;
                    }
                }

                btn_analisa = `
                        <a href="#" onclick="analisar(this)" data-companyid="${element.company_id}" data-moviments="${element.id}" data-desc="${element.historic}" data-value="${element.value_mov}" data-valueservice="${valueService}" data-tpservice="${nameService}" data-contada="${element.provider}" data-emp="${company_name}" id="btn-analisar-transacao" data-toggle="modal" data-target="#analiseTran">Analisar</a>
                    `;
            }
            
            if (excluir == true && element.status_id == '1')
            {
                btn_excluir = `
                    <a href="#" data-toggle="modal" id="btn-excluir-transacao" data-id="${element.id}" onclick="excluir(this)" data-target="#excluiTran">Excluir</a>
                `;
            }

            for (let index = 0; index < status.length; index++) {
                if(status[index].id == element.status_id)
                {
                    statusName = status[index].description;
                    break;
                }
            }
            
            html += `
                <tr data-status="${statusName}">
                    <td>
                        <div class="media">
                            <div class="media-body">
                                <span class="media-meta pull-right">${element.created}</span>
                                <h4 class="title">
                                    ${element.provider}
                                    <span class="pull-right ${statusName}">(${statusName})</span>
                                    ${btn_analisa}
                                    ${btn_excluir}
                                </h4>
                                <p class="summary">${element.historic}</p>
                                <small class="title">${element.analise_description}</small>
                            </div>       
                        </div>
                    </td>
                </tr>
            `;
            // Limpa
            btn_excluir = "";
            btn_analisa = "";
        });
        
        linhas.html(html);
        
        if (dados.length == 0) {
          linhas.html("<p class='text-center'>Nenhuma movimentação<p>");
        }

    }

    /** Filtro das transações */
    $(".star").on("click", function() {
        $(this).toggleClass("star-checked");
    });

    $(".ckbox label").on("click", function() {
        $(this).parents("tr").toggleClass("selected");
    });

    $(".btn-filter").on("click", function() {
        var $target = $(this).data("target");
        
        if ($target != "all") {
            $(".table tr").css("display", "none");
            $('.table tr[data-status="' + $target + '"]').fadeIn("slow");
        } else {
            $(".table tr").css("display", "none").fadeIn("slow");
        }
    });
});

function excluir(e) {
    var id      = $(e).attr("data-id");
    var url     = '/home/delete';
    var message = "";
    var btn_ex  = $("#btn-excluir");

    btn_ex.click(function(){
        $.ajax({
            url: BASE_URL + url,
            type: "post",
            data: { q: id },
            dataType: "json",
            success: function(data) {
                console.log(data)
            },
            error: function (err)
            {
                console.log(err);
            }
        });
    });
}

function analisar(e)
{
    var id          = $(e).attr("data-moviments");
    var historic    = $(e).attr("data-desc");
    var contratante = $(e).attr("data-emp");
    var contratada  = $(e).attr("data-contada");
    var value       = $(e).attr("data-value");
    var tpservice   = $(e).attr("data-tpservice");
    var valueserv   = $(e).attr("data-valueservice");
    var company_id  = $(e).attr("data-companyid");

    if (valueserv != value)
    {
        $("#edit_value").css('border', '1px solid red');    
        $("#edit_value_tabela").css("border", "1px solid red");
    }
    else {
        $("#edit_value").css("border", "1px solid green");
        $("#edit_value_tabela").css("border", "1px solid green");        
    }

    $("#moviments").val(id);
    $("#edit_desc").val(historic);
    $("#edit_service").val(tpservice);
    $("#edit_cotante").val(contratante);
    $("#edit_contada").val(contratada);
    $("#edit_value").val(value);
    $("#edit_value_tabela").val(valueserv);
    $("#company_id").val(company_id);
}

function aprovar()
{
    $("#edit-form").attr('action', BASE_URL+'/home/approve');
}

function reprovar() {
  $("#edit-form").attr("action", BASE_URL + "/home/reprove");
}
