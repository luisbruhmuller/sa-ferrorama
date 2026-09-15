document.getElementById("enviar_login")?.addEventListener("click", function () {

    const login = document.getElementById("login-login").value;
    const senha = document.getElementById("login-senha").value;

    const usuarios = JSON.parse(localStorage.getItem("usuarios")) || [];

    const usuarioEncontrado = usuarios.find(u =>
        u.login === login && u.senha === senha
    );

    const sucesso = document.getElementById("alert-sucesso");
    const erro = document.getElementById("alert-erro");

    sucesso.classList.add("d-none");
    erro.classList.add("d-none");

    if (usuarioEncontrado) {

        sucesso.classList.remove("d-none");

        setTimeout(() => { window.location.href = '../Tela Home/tela_geral_home.php'; }, 800);

    } else {

        erro.classList.remove("d-none");
    }
});

document.getElementById("enviar_cadastro")?.addEventListener("click", function () {

    const login = document.getElementById("login").value;
    const senha = document.getElementById("senha").value;
    const confirmarSenha = document.getElementById("confirmar-senha").value;

    const alertaSucesso = document.getElementById("alert-sucesso");
    const alertaErro = document.getElementById("alert-erro");

    alertaSucesso.classList.add("d-none");
    alertaErro.classList.add("d-none");

    if (senha !== confirmarSenha) {
        alertaErro.textContent = "As senhas não coincidem!";
        alertaErro.classList.remove("d-none");
        return;
    }

    const usuarios = JSON.parse(localStorage.getItem("usuarios")) || [];

    const existe = usuarios.find(u => u.login === login);

    if (existe) {
        alertaErro.textContent = "Usuário já existe!";
        alertaErro.classList.remove("d-none");
        return;
    }

    usuarios.push({
        login: login,
        senha: senha
    });

    localStorage.setItem("usuarios", JSON.stringify(usuarios));

    alertaSucesso.textContent = "Usuário cadastrado com sucesso!";
    alertaSucesso.classList.remove("d-none");

    document.getElementById("login").value = "";
    document.getElementById("senha").value = "";
    document.getElementById("confirmar-senha").value = "";
});