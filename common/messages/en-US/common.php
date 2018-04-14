<?php

return [
    'Model.Id' => 'Id',
    'Model.CreatedAt' => 'Created at',
    'Model.UpdatedAt' => 'Updated at',

    'Model.Username' => 'Username',
    'Model.AuthKey' => 'Authorization key',
    'Model.PasswordHash' => 'Password hash',
    'Model.PasswordResetToken' => 'Password reset token',
    'Model.Email' => 'Email',
    'Model.Gender' => 'Gender',
    'Model.Status' => 'Status',
    'Model.Root' => 'Root',
    'Model.LoggedAt' => 'Last login',
    'Model.LanguageId' => 'Language',
    'Model.Avatar' => 'Avatar',
    'Model.Title' => 'Title',
    'Model.Content' => 'Content',
    'Model.Name' => 'Name',
    'Model.NativeName' => 'Native name',
    'Model.Code-ISO-639-1' => 'Code ISO-639-1',
    'Model.Code-ISO-Language' => 'Code ISO-Language',
    'Model.Description' => 'Description',
    'Model.Action' => 'Action',
    'Model.ActionGroup' => 'Action group',
    'Model.UserId' => 'User',
    'Model.GroupId' => 'Group',
    'Model.PermissionId' => 'Permission',
    'Model.Tag' => 'Tag',
    'Model.Items' => 'Items',
    'Model.Timezone' => 'Timezone',
    'Model.FirstName' => 'First name',
    'Model.LastName' => 'Last name',
    'Model.Password' => 'Password',
    'Model.RepeatPassword' => 'Repeat password',
    'Model.AvailableAt' => 'Available at',
    'Model.Type' => 'Type',
    'Model.Image' => 'Image',
    'Model.Video' => 'Video',
    'Model.ShortContent' => 'Short content',
    'Model.CustomerId' => 'Customer',
    'Model.Gallery.Items' => 'Images',
    'Model.Body' => 'Message',
    'Model.VerifyCode' => 'Verify code',
    'Model.Token' => 'Token',

    'Gender.Male' => 'Male',
    'Gender.Female' => 'Female',

    'Status.Active' => 'Active',
    'Status.Inactive' => 'Inactive',

    'Root.Yes' => 'Yes',
    'Root.No' => 'No',

    'User.UsernameTaken' => 'This username has already been taken.',
    'User.EmailTaken' => 'This email has already been taken.',
    'Customer.EmailTaken' => 'This email has already been taken.',

    'Gallery.Tag.Frontend' => 'Frontend',

    'Content.Tag.AboutUs' => 'About us',
    'Content.Tag.PrivacyPolicy' => 'Privacy policy',
    'Content.Tag.TermsOfUse' => 'Terms of use',

    'LoginForm.Email' => 'Email',
    'LoginForm.Password' => 'Password',
    'LoginForm.RememberMe' => 'Remember me',
    'LoginForm.ErrorIncorrectUsernamePassword' => 'Email or password is invalid.',

    'SignupForm.FirstName' => 'First name',
    'SignupForm.LastName' => 'Last name',
    'SignupForm.Email' => 'Email',
    'SignupForm.Password' => 'Password',
    'SignupForm.LanguageId' => 'Language',
    'SignupForm.ErrorEmailAlreadyUsed' => 'This email address has already been taken.',

    'ResetPassword.Success' => 'New password saved.',

    'RequestPasswordReset.Success' => 'Check your email for further instructions.',
    'RequestPasswordReset.Error' => 'Sorry, we are unable to reset password for the provided email address.',

    'Contact.Error' => 'There was an error sending your message.',

    'PasswordResetRequestForm.ErrorEmailNotExists' => 'This email is invalid or not exists.',

    'Mail.PasswordResetRequest.Subject' => 'Password reset for: {name}',
    'Mail.PasswordResetRequest.Body.Html' => '
        <p>Hello {name},</p>
        <p>Follow the link below to reset your password:</p>
        <p>{link}</p>
    ',
    'Mail.PasswordResetRequest.Body.Text' => "
        Hello {name},\n\n
        Follow the link below to reset your password:\n\n
        {link}
    ",

    'Mail.Contact.Subject' => 'Contact email from website',
];