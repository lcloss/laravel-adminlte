# Laravel Starter Kit with AdminLTE, Fortify and Livewire

## About
This project is an admin panel Starter Kit for Laravel projects, based on AdminLTE theme, Fortify as authentication and Livewire.

This is incomplete work, and still in development. 
Please, read the TODOs section about upcoming developments.

I hope you like it, and can start your project faster.

## Features
- ACL logic to authorize users access your project
- Role based permissions

## Installation
1. Generate node_modules:

```bash
$ npm install
```

2. Generate mix assets:
```bash
$ npm run dev 
```

3. Change `.env` file to match your requirements
```bash
$ copy .env.example .env
```

4. Generate Laravel Key

```bash
$ php artisan key:generate 
```

5. Create your database, accodanly to your `.env` file


6. Run migrations with seed

```bash
$ php artisan migrate --seed 
```

7. Run your server

```bash
$ php artisan serve
```

8. Log in as admin:

- User: admin@admin.com
- Password: password

## Configuration
[TODO]

## Warranty and Support
Please, take in attention that this is no warranty.

## Trademarks and Copyrights
- AdminLTE is free theme from [Colorlib](https://colorlib.com/)

## License
- MIT

## TODOs
- When User is approved, change user status from Pending to Active.
- Check Tenant's status also.
- Create user alerts.
- When User 
- Create views (show) for Tenants, Users, Roles and Permissions.
- Localization and Translations.
- Tests.

## Credits and contributions
- Luciano Closs 
