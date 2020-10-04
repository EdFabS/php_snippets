create table users (
    id integer primary key,
    user_name varchar(255) NOT NULL,
    user_email varchar(255) NOT NULL,
    user_message text NOT NULL)AUTO_INCREMENT=1;
    ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;