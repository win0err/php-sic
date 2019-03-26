# Simplified Instructional Computer VM written in PHP

**Work in progress**

## Installation

### Docker-way

**Build a container**
```bash
docker build -t php-sic .
# Or using make:
make build
```

**Run**
```bash
docker run --rm -v $PWD:/app php-sic [command and some arguments for it]
```

Also you may create an alias for simple running PHP SIC:
```bash
# Just add the following line to your ~/.zshrc, ~/.bashrc or ~/.profile
alias php-sic='docker run --rm -v $PWD:/app php-sic'
# After that, you will be able to run commands easier:
php-sic [command and some arguments for it]
```

### Classic way
Dependencies: PHP 7.2 or newer and composer installed.

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

---
_Developed by [Sergei Kolesnikov](https://github.com/win0err)_
