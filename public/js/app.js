$(document).ready(function () {
    $('.cpf').mask('000.000.000-00');
    $('.telefone').mask('(00) 00000-0000');
    $('.cep').mask('00000-000');
    $('.cpf').on('input', function () {
        var cpf = $(this).val();
        if (cpf.length === 14) {
            if (validarCPF(cpf)) {
                $(this).removeClass('invalid');
                var idPessoa = 0;
                if($('.idPessoa').length > 0){
                    idPessoa = $('.idPessoa').val();
                }
                if (cpfExiste(cpf,idPessoa)) {
                    $('.message-cpf').text('CPF já cadastrado!');
                    $('.message-cpf').css('color', 'red');
                    $(this).addClass('invalid');
                } else {
                    $('.message-cpf').text('CPF válido!');
                    $('.message-cpf').css('color', 'green');
                    $(this).removeClass('invalid');
                }

            } else {
                $(this).addClass('invalid');
                $('.message-cpf').text('CPF inválido!');
                $('.message-cpf').css('color', 'red');
            }
        } else {
            $(this).removeClass('invalid');
            $('.message-cpf').text('');
        }
    });

    $('.cep').on('blur', function () {
        var cep = $(this).val().replace(/\D/g, '');
        if (cep.length === 8) {
            $.ajax({
                url: 'https://viacep.com.br/ws/' + cep + '/json/',
                dataType: 'json',
                success: function (data) {
                    if (!data.erro) {
                        // CEP válido
                        $('.cep').removeClass('invalid-cep');
                        $('.message-cep').text('CEP válido!');
                        $('.message-cep').css('color', 'green');
                    } else {
                        // CEP inválido
                        $('.cep').addClass('invalid-cep');
                        $('.message-cep').text('CEP inválido!');
                        $('.message-cep').css('color', 'red');
                    }
                },
                error: function () {
                    // Erro na requisição
                    $('.message-cep').text('Erro ao consultar o CEP. Tente novamente mais tarde.');
                    $('.message-cep').css('color', 'red');
                }
            });
        } else {
            // CEP inválido
            $('.cep').addClass('invalid-cep');
            $('.message-cep').text('CEP inválido!');
            $('.message-cep').css('color', 'red');
        }
    });

    $('.data_nacimento').on('blur', function () {
      var dataNascimento = $(this).val();
      if (dataNascimento.length === 10) {
        if (validarDataNascimento(dataNascimento)) {
          $(this).removeClass('invalid');
          $('.message-data-nascimento').text('Data de nascimento válida!');
          $('.message-data-nascimento').css('color', 'green');
        } else {
          $(this).addClass('invalid');
          $('.message-data-nascimento').text('Data de nascimento inválida!');
          $('.message-data-nascimento').css('color', 'red');
        }
      }
    });

    $('.confirm-password').on('input', function () {
        var senha = $('.password').val();
        var confirmarSenha = $(this).val();
        if (senha.length > 0 && confirmarSenha.length > 0) {
            if (validarSenha(senha, confirmarSenha)) {
                $(this).removeClass('invalid');
                $('.message-password').text('Senhas conferem!');
                $('.message-password').css('color', 'green');
            } else {
                $(this).addClass('invalid');
                $('.message-password').text('Senhas não conferem!');
                $('.message-password').css('color', 'red');
            }
        } else {
            $(this).removeClass('invalid');
            $('.message-password').text('');
        }
    });

    $('form').on('submit', function (event) {

        if ($('.cep').length > 0) {
            var cep = $('.cep').val().replace(/\D/g, '');
            if (cep.length !== 8 || cepInput.hasClass('invalid-cep')) {
                event.preventDefault(); // Impede o envio do formulário
                alert('CEP inválido!');
                return false;
            }
        }

        if ($('.cpf').length > 0) {
            var cpf = $('.cpf').val();
            if (!validarCPF(cpf)) {
                event.preventDefault(); // Impede o envio do formulário
                alert('CPF inválido!');
                return false;
            }

            var idPessoa = 0;
            if($('.idPessoa').length > 0){
                idPessoa = $('.idPessoa').val();
            }
            if (cpfExiste(cpf, idPessoa)) {
                event.preventDefault(); // Impede o envio do formulário
                alert('CPF já cadastrado!');
                return false;
            }
        }

        if ($('.data-nacimento').length > 0) {
          var dataNascimento = $('.data-nacimento').val();
          if (!validarDataNascimento(dataNascimento)) {
            event.preventDefault(); // Impede o envio do formulário
            alert('Data de nascimento inválida!');
            return false;
          }
        }

        if (($('.password').length > 0) && ($('.confirm-password').length > 0)) {
            var senha = $('.password').val();
            var confirmarSenha = $('.confirm-password').val();
            if (!validarSenha(senha, confirmarSenha)) {
                event.preventDefault(); // Impede o envio do formulário
                alert('Senhas não conferem!');
                return false;
            }
        }

        if ($('input').hasClass('invalid')) {
            event.preventDefault();
            alert('Campo está inválido!');
            return false;
        }
    });

    function validarCPF(cpf) {
        cpf = cpf.replace(/\D/g, ''); // Remove caracteres não numéricos
        if (cpf.length !== 11 || /^(\d)\1{10}$/.test(cpf)) {
            return false;
        }
        var soma = 0;
        var resto;
        for (var i = 1; i <= 9; i++) {
            soma = soma + parseInt(cpf.substring(i - 1, i)) * (11 - i);
        }
        resto = (soma * 10) % 11;
        if (resto === 10 || resto === 11) {
            resto = 0;
        }
        if (resto !== parseInt(cpf.substring(9, 10))) {
            return false;
        }
        soma = 0;
        for (var i = 1; i <= 10; i++) {
            soma = soma + parseInt(cpf.substring(i - 1, i)) * (12 - i);
        }
        resto = (soma * 10) % 11;
        if (resto === 10 || resto === 11) {
            resto = 0;
        }
        if (resto !== parseInt(cpf.substring(10, 11))) {
            return false;
        }
        return true;
    }



    function cpfExiste(cpf,id) {
        var existe = false;
        var idPessoa = 0;
        $.ajax({
            url: '/api/cpf?cpf=' + cpf.replace(/\D/g, ''),
            async: false,
            dataType: 'json',
            success: function (data) {
                existe = data.cpf;
                idPessoa = data.id;
            }
        });
        if(idPessoa == id){
            return false;
        }
        return existe;
    }
    function validarDataNascimento(dataNascimento) {
      var dataAtual = new Date();
      var dataLimite = new Date();
      dataLimite.setFullYear(dataAtual.getFullYear() - 100); // Subtrai 100 anos da data atual

      // Converte a data de nascimento para um objeto Date
      var partesData = dataNascimento.split('-');
      var data = new Date(partesData[0], partesData[1] - 1, partesData[2]);

      // Verifica se a data selecionada não é o dia atual
      if (data.toDateString() === dataAtual.toDateString()) {
        return false;
      }

      // Verifica se a data está dentro do limite de 100 anos atrás
      if (data < dataLimite) {
        return false;
      }

      // Verifica se a data está no máximo até o ano atual
      if (data.getFullYear() > dataAtual.getFullYear()) {
        return false;
      }

      return true;
    }

    function validarSenha(senha, confirmarSenha) {
        if (senha !== confirmarSenha) {
            return false;
        }

        return true;
    }
});
