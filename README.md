WordPress Twitter Wrapper
=========================

Uses the twitteroauth library (https://github.com/abraham/twitteroauth) to authenticate, query and return the Twitter API response.

Basic usage:
------------
```javascript
var args = {};
args["q"] = "Twitter";
args["count"] = 5;

var data = {
	action: 'twitter_api',
  	account: 'telecomstweet',
    query: 'search/tweets',
    args: args,
}

$.post('/wp-admin/admin-ajax.php', data, function(response) {
	var response_obj = $.parseJSON(response);
	console.log(response_obj);
});
```