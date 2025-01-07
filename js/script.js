// Remover popup de notificacao
if (document.getElementById("popup")) {
    var time = setInterval(() => {
        document.body.removeChild(document.getElementById("popup"));
        clearInterval(time);
    }, 5000);
}

// Verificacao formulario
if (document.querySelector('form')) {
    const form = document.querySelector('form');
    form.addEventListener('submit', function (event) {
        const login = document.getElementById('login').value;
        const senha = document.getElementById('senha').value;

        if (!login || !senha) {
            document.body.innerHTML = '<p id="popup">Todos os campos são obrigatórios!</p>';
            event.preventDefault();
        }
    });
}

// Função de formatacao de CPF
function formatCPF(cpfInput, table = false) {
    let cpf = table ? cpfInput.innerHTML.replace(/\D/g, '') : cpfInput.value.replace(/\D/g, '');

    // Formata o CPF no padrao 000.000.000-00
    if (cpf.length > 3 && cpf.length <= 6) {
        cpf = cpf.replace(/(\d{3})(\d+)/, '$1.$2');
    } else if (cpf.length > 6 && cpf.length <= 9) {
        cpf = cpf.replace(/(\d{3})(\d{3})(\d+)/, '$1.$2.$3');
    } else if (cpf.length > 9) {
        cpf = cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{1,2})/, '$1.$2.$3-$4');
    }

    if (!table) {
        cpfInput.value = cpf;
    } else {
        cpfInput.innerHTML = cpf;
    }
}

// Função de formatacao de RG
function formatRG(rgInput, table = false) {
    let rg = table ? rgInput.innerHTML.replace(/\D/g, '') : rgInput.value.replace(/\D/g, '');

    // Formata o RG no padrao 00.000.000
    if (rg.length > 2 && rg.length <= 5) {
        rg = rg.replace(/(\d{2})(\d+)/, '$1.$2');
    } else if (rg.length > 5 && rg.length <= 8) {
        rg = rg.replace(/(\d{2})(\d{3})(\d+)/, '$1.$2.$3');
    } else if (rg.length > 8) {
        rg = rg.replace(/(\d{2})(\d{3})(\d{3})(\d+)/, '$1.$2.$3-$4');
    }

    if (!table) {
        rgInput.value = rg;
    } else {
        rgInput.innerHTML = rg;
    }
}

// Aplica a formatacao de CPF e RG nas celulas da tabela
document.addEventListener('DOMContentLoaded', function () {
    if (document.querySelectorAll('.cpf')) {
        const cpfCells = document.querySelectorAll('.cpf');
        const rgCells = document.querySelectorAll('.rg');

        // Formata todos os CPFs
        cpfCells.forEach(function (cell) {
            formatCPF(cell, true);
        });

        // Formata todos os RGs
        rgCells.forEach(function (cell) {
            formatRG(cell, true);
        });
    }
});