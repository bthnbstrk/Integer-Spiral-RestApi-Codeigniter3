# Integer-Spiral-RestAPI

Bu Rest-Api Codeigniter 3 frameworkü kullanılarak geliştirilmiştir. Verilen iki sayının salyangoz matrisi kenarları
şeklinde ayarlanarak veritabanına kayıt edilmesi sağlanmıştır.

# 1. Adım

Veritabanı dosyasını map_case isimli bir veritabanı oluşturup içine aktarın.

# 2. Adım

Proje klasörünü bir sunucuya atın.

# 3. Adım

X-Api-Key olarak tüm isteklerde "adamasmaca" girmeniz gerekir.<br />
1.Adımda import ettiğiniz bb_keys tablosu içerisinde pastel_key içerisindeki değeri değiştirip yeni x-api-key inizi
oluşturabilirsiniz veya bir yenisini ekleyebilirsiniz.

# 4.Adım

Kullanıma hazırsınız <br />

Proje ana url sonuna:

GET www.sizinverdiginizklasoradi/api/layout/id   <br />
GET www.sizinverdiginizklasoradi/api/layouts  <br />
POST www.sizinverdiginizklasoradi/api/layouts/create  <br />
Params: point_x : 5 point_y : 6 (Form-data)

# 5.Kaynaklar

https://github.com/yidas/codeigniter-rest
https://www.geeksforgeeks.org/circular-matrix-construct-a-matrix-with-numbers-1-to-mn-in-spiral-way/

# Ekstra

Proje klasörü içerisinde postman import collection dosyası ve basit dökümantasyonumsu bir pdf yer almakta :)



