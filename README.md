# ตัวอย่าง php5.5 ต่อ Keycloak
เนื่องจากเป็นตัวอย่าง จึงไม่ได้ทำ Dockerfile ใหม่ ใช้ของ opensource ที่มีอยู่แล้ว จึงจำเป็นจะต้องเข้าไป exec เพื่อติดตั้งสิ่งต่างๆเพิ่ม
## Install 
1. clone git ลงมาไว้ที่ /root/keycloak/keycloak-php5-demo2 เปลี่ยนพาธอะไรก็ได้นะครับ แต่ต้องเปลี่ยนทุกคำสั่งหลังจากนี้ด้วบ
2.  `docker run -d -p 8888:80 --name keycloak-php-2 -v /root/keycloak/keycloak-php5-demo2:/var/www/html nyanpass/php5.5:5.5-apache` 
3.  `docker exec -it keycloak-php-2 bash`
    1. `apt-get update && apt-get upgrade -y`
    2. `apt-get install git -y`  
    3.  `update-ca-certificates --fresh`
    4.  `php composer.phar update`
    5. `exit`


## เข้าใช้งาน
้http://localhost:8888  โดยจะใช้ Keycloak ที่ https://keycloak.geniustree.io/ โดยสามารถ register ที่หน้า login ได้เลย 
สามารถ register ได้สองแบบ form หรือ github 
