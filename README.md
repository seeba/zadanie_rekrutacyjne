Polecenia CLI:

php artisan programmer:create imie nazwisko email pesel hasło --lang=PHP --lang=javascript
php artisan programmer:adult:activate


API
/api/login 

{
  "email": "zadanie@rekrutacyjne.pl",
  "password": "admin123"

}

/api/users

{
  "first_name": "Sebastian",
  "last_name": "Pluta",
  "pesel": "11111111111",
  "email": "poczta@sebastianpluta.pl",
  "password": "haslo123",
  "languages": [
      {
          "name": "PHP"
      },
      {
          "name": "JAVA"
      }
  ]
}
