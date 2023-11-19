// lista todos os usuario http://localhost:8989/api/users
// metodo get
// autoriza usuario gernado token jwt metodo post http://localhost:8989/api/auth/login
// criacao de usuario metodo post http://localhost:8989/api/users
// atualizar usuario metodo put http://localhost:8989/api/users/3 o 3 representa o id do usuario no banco
// apagar usuario metodo delete http://localhost:8989/api/users/3 o id representa o id do usuario
// autoriza usuario gernado token jwt metodo post http://localhost:8989/api/auth/login
// ESSA VAI GERAR TOKEM DE AUTENTICAÇAO
// JWT
// PRA LOGAR

export const API_URL = "http://localhost:8989/api/";

export function USER_POST(body) {
    return {
        url: API_URL + "users",
        options: {
            method: "POST",
            headers: {
                Accept: "application/json",
                "Content-Type": "application/json",
            },
            body: JSON.stringify(body),
        },
    };
}
