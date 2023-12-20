<body style="background-color: #ffffff; padding:10px; font-family:Arial, Helvetica, sans-serif">
    <table
        style="width:100%;
        max-width:700px;
        border:1px solid #C7C7C7;
        border-radius: 10px;
        margin-top: 10px;
        background-color: #F8F8F8;
        padding-top:10px;
        padding-bottom:10px"
        border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
            <td align="center">
                <span style="font-size: 30px; color:black; font-weight: bold">{{ $appName }}</span>
                <br />
                <br />
            </td>
        </tr>
        <tr>
            <td>
                <div
                    style="
                    width: 100%;
                    background: #0058DB;
                    max-width: 700px;
                    text-align: center;
                    ">
                    <h1
                        style="
                        font-size: 30px;
                        color: #ffffff;
                        padding:20px 0 20px 0;
                        margin-left:225px;
                        ">
                        Redefina a sua senha.
                    </h1>
                </div>
            </td>
        </tr>
        <tr>
            <td align="center">
                <p style="font-size: 22px; text-align:center; color:black">Prezado {{ $user->name }},</p>
            </td>
        </tr>
        <tr>
            <td align="center">
                <p style="font-size: 16px; text-align:center; color:black; padding: 10px">
                    Recebemos uma solicitação para recuperar sua senha de acesso ao nosso sistema de ouvidoria. Para
                    iniciar o processo de recuperação, por favor, clique no link abaixo:
                </p>
            </td>
        </tr>
        <tr>
            <td align="center">
                <a href={{ $token }} target="_blank" style="text-decoration:none">
                    <button
                        style="
                    background-color: #0058DB;
                    border: none;
                    color:
                    white;
                    border-radius: 15px; font-weight: bold;
                    font-size: 18px;
                    padding: 20px;
                    padding-left: 60px; padding-right: 60px;">
                        REDEFINIR SENHA
                    </button>
                </a>
                <br /><br />
            </td>
        </tr>
        <tr>
            <td align="center">
                <p style="font-size: 16px; width: 80%; text-align: center; color:black">
                    Este link o levará a uma página segura onde você poderá escolher uma nova senha para sua conta.
                    Certifique-se de concluir esse processo o mais breve possível, pois o link irá expirar por motivos
                    de segurança.
                    Se você não solicitou essa recuperação de senha desconsidere este e-mail.
                    <br /><br />
                    Atenciosamente, Ouvidoria da Prefeitura Municipal de {{ $appName }}
                </p>
            </td>
        </tr>
        <tr>
        </tr>
    </table>
</body>
