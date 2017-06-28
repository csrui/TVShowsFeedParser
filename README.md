# TVShowsFeedParser

Filters torrent feeds for specific seasons and episodes.

### Usage

Query  | Type   | Description
------ | ------ | -----------
show   | INT    | The ID of the show you want to watch. This is the ID from [ShowRSS].
starts | STRING | The Season and Episode (separated by a colon [`:`])
filter | INT    | An integer to specify the quality. (e.g. `720`)

### Examples

`http://yourserver.com/?show=5&starts=06:19&filter=720`

Let's break it down...

* show=5 means we are looking at the Big Bang Theory feed
* starts=06:19 means we are seeing only torrents episode 19 from season 6 and up 
* filter=720 means we only want 720p results

Note: Currently works only with [ShowRSS].

[ShowRSS]: https://showrss.info