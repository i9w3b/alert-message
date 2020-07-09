<p align="center" class="text-center" style="text-align:center;"><a href="https://github.com/i9w3b" target="_blank"><img src="https://cdn.jsdelivr.net/gh/i9w3b/cdn/img/logo-200px.png" width="200"></a></p>
<p align="center" class="text-center" style="text-align:center;">
<p align="center" class="text-center" style="text-align:center;">
<a href="https://github.com/i9w3b/alert-message/blob/master/LICENSE.md"><img src="https://img.shields.io/github/license/i9w3b/alert-message" alt="License"></a>
<a href="https://github.com/i9w3b/alert-message"><img src="https://img.shields.io/github/languages/count/i9w3b/alert-message" alt="GitHub Language Count"></a>
<a href="https://github.com/i9w3b/alert-message"><img src="https://img.shields.io/github/repo-size/i9w3b/alert-message" alt="GitHub Repo Size"></a>
<a href="https://github.com/i9w3b/alert-message/releases"><img src="https://img.shields.io/github/v/release/i9w3b/alert-message" alt="GitHub Release"></a>
<a href="https://packagist.org/packages/i9w3b/alert-message"><img alt="Packagist Downloads" src="https://img.shields.io/packagist/dt/i9w3b/alert-message"></a>
</p>


## AlertMessage

Notificações para laravel

## Instalação

Você pode instalar o pacote via compositor:

```bash
composer require i9w3b/alert-message
```

## Uso

Blade:

```php
@jquery
@toastr_css
@toastr_js
@alertmessage
```

Controller:

```php
// toastr sem título
toastr()->warning('My name is Inigo Montoya. You killed my father, prepare to die!')

// toastr com título
toastr()->success('Have fun storming the castle!', 'Miracle Max Says')

// toastr error com título
toastr()->error('I do not think that word means what you think it means.', 'Inconceivable!')

// Substitua as opções globais de configuração em 'config/alertmessage.php'
toastr()->success('We do have the Kapua suite available.', 'Turtle Bay Resort', ['timeOut' => 5000])
```

### Configurações:

```php
// config/alertmessage.php
<?php

return [
    
];
```

Para obter uma lista das opções disponíveis, consulte a documentação do toastr.js [documentação](https://github.com/CodeSeven/toastr).

### Changelog

Por favor, consulte [CHANGELOG](CHANGELOG.md) para obter mais informações sobre o que mudou recentemente.

## Coloborar

Por favor, consulte [CONTRIBUTING](CONTRIBUTING.md) para obter detalhes.

### Segurança

Se você descobrir algum problema relacionado à segurança, envie um email para `marcelosenaonline@gmail.com` em vez de usar o rastreador de problemas.

## Créditos

- [Marcelo Sena](https://github.com/i9w3b)
- [Todos os Colaboradores](../../contributors)

## Licença

Licença MIT (MIT). Consulte o [Arquivo de Licença](LICENSE.md) para obter mais informações.
