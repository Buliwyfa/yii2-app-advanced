<?php

return [
    'Model.Id' => 'Id',
    'Model.CreatedAt' => 'Criado em',
    'Model.UpdatedAt' => 'Alterado em',

    'Model.Username' => 'Usuário',
    'Model.AuthKey' => 'Chave de autorização',
    'Model.PasswordHash' => 'Hash da senha',
    'Model.PasswordResetToken' => 'Token de recuperação da senha',
    'Model.Email' => 'E-mail',
    'Model.Gender' => 'Sexo',
    'Model.Status' => 'Status',
    'Model.Root' => 'Root',
    'Model.LoggedAt' => 'Último login',
    'Model.LanguageId' => 'Idioma',
    'Model.Avatar' => 'Avatar',
    'Model.Title' => 'Título',
    'Model.Content' => 'Conteúdo',
    'Model.Name'=> 'Nome',
    'Model.NativeName'=> 'Nome nativo',
    'Model.Code-ISO-639-1'=> 'Código ISO-639-1',
    'Model.Code-ISO-Language'=> 'Código ISO-Language',
    'Model.Description' => 'Descrição',
    'Model.Action' => 'Ação',
    'Model.ActionGroup' => 'Grupo da ação',
    'Model.UserId' => 'Usuário',
    'Model.GroupId' => 'Grupo',
    'Model.PermissionId' => 'Permissão',
    'Model.Tag' => 'Tag',
    'Model.Items' => 'Itens',
    'Model.Timezone' => 'Fuso-horário',
    'Model.FirstName' => 'Nome',
    'Model.LastName' => 'Sobrenome',
    'Model.Password' => 'Senha',
    'Model.RepeatPassword' => 'Repetir senha',
    'Model.AvailableAt' => 'Disponível em',
    'Model.Type' => 'Tipo',
    'Model.Image' => 'Imagem',
    'Model.Video' => 'Video',
    'Model.ShortContent' => 'Resumo',
    'Model.CustomerId' => 'Cliente',
    'Model.Gallery.Items' => 'Imagens',
    'Model.Body' => 'Mensagem',
    'Model.VerifyCode' => 'Código de verificação',

    'Gender.Male' => 'Masculino',
    'Gender.Female' => 'Feminino',

    'Status.Active' => 'Ativo',
    'Status.Inactive' => 'Inativo',

    'Root.Yes' => 'Sim',
    'Root.No' => 'Não',

    'User.UsernameTaken' => 'Este usuário já está sendo utilizado.',
    'User.EmailTaken' => 'Este e-mail já está sendo utilizado.',
    'Customer.EmailTaken' => 'Este e-mail já está sendo utilizado.',

    'Gallery.Tag.Frontend' => 'Frontend',

    'Content.Tag.AboutUs' => 'Sobre nós',
    'Content.Tag.PrivacyPolicy' => 'Política de privacidade',
    'Content.Tag.TermsOfUse' => 'Termos de uso',

    'LoginForm.Email' => 'Email',
    'LoginForm.Password' => 'Senha',
    'LoginForm.RememberMe' => 'Lembrar-me',
    'LoginForm.ErrorIncorrectUsernamePassword' => 'E-mail ou senha inválido.',

    'SignupForm.FirstName' => 'Nome',
    'SignupForm.LastName' => 'Sobrenome',
    'SignupForm.Email' => 'E-mail',
    'SignupForm.Password' => 'Senha',
    'SignupForm.LanguageId' => 'Idioma',
    'SignupForm.ErrorEmailAlreadyUsed' => 'Este e-mail já está sendo usado.',

    'ResetPassword.Success' => 'A nova senha foi definida.',

    'RequestPasswordReset.Success' => 'Verifique seu e-mail para as demais instruções.',
    'RequestPasswordReset.Error' => 'Desculpe, não conseguimos redefinir sua senha com o e-mail informado.',

    'Contact.Error' => 'Ocorreu um erro ao enviar sua mensagem.',

    'PasswordResetRequestForm.ErrorEmailNotExists' => 'Este e-mail é inválido ou inexistente.',

    'Mail.PasswordResetRequest.Subject' => 'Troca de senha para: {name}',
    'Mail.PasswordResetRequest.Body.Html' => '
        <p>Olá {name},</p>
        <p>Acesse o link abaixo para redefinir sua senha:</p>
        <p>{link}</p>
    ',
    'Mail.PasswordResetRequest.Body.Text' => "
        Olá {name},\n\n
        Acesse o link abaixo para redefinir sua senha:\n\n
        {link}
    ",

    'Mail.Contact.Subject' => 'E-mail de contato do website',
];