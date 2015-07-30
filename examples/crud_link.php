1.
// insert

curl -v -XPUT http://127.0.0.1:8098/riak/people/mariusz \
-H 'Link: </riak/people/pawel>; riaktag="friend"' \
-H 'Link: </riak/people/piotr>; riaktag="friend"' \
-H 'Link: </riak/people/adam>; riaktag="mentor"' \
-H "Content-Type: text/plain" \
-d 'Jest dobrym kierowca.'


curl -v -XPUT http://127.0.0.1:8098/riak/people/pawel \
-H 'Link: </riak/people/adam>; riaktag="mentor"' \
-H "Content-Type: text/plain" \
-d 'Jezdze seatem.'


curl -v -XPUT http://127.0.0.1:8098/riak/people/piotr \
-H 'Link: </riak/people/adam>; riaktag="mentor"' \
-H "Content-Type: text/plain" \
-d 'Jezdze fordem.'


curl -v -XPUT http://127.0.0.1:8098/riak/people/adam \
-H "Content-Type: text/plain" \
-d 'Jezdze suwem.'


2.
select

curl -v http://127.0.0.1:8098/riak/people/mariusz
curl -v http://127.0.0.1:8098/riak/people/pawel
curl -v http://127.0.0.1:8098/riak/people/adam
curl -v http://127.0.0.1:8098/riak/people/piotr


3.


4. wyciagamy powiazane

curl -v http://127.0.0.1:8098/riak/people/mariusz/people,friend,1


curl -v http://127.0.0.1:8098/riak/people/mariusz/people,mentor,1




