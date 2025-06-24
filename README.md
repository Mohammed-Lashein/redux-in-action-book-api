# Redux in action book api

This repo is intended to be an api to be used along with [the frontend part .](https://github.com/Mohammed-Lashein/redux-in-action-source-code)

I could have used `json-server` as mentioned in the book and called it a day . However I wanted to train also on **graphql** so I thought this is a good opportunity to train on that . 

Many of the boilerplate present here will be [from this repository .](https://github.com/Mr0Bread/fullstack-test-starter)

# I will also write some short notes here about the challenges I faced and how I solved them . 

## Note 1 : When I tried to clone the boilerplate repo

I got this error from git : 
```bash
fatal: destination path '.' already exists and is not an empty directory.
```

Yes I created a repo for my code, but I wanted to pull the boilerplate code from the aforementioned repo . 

I asked chatGPT and he suggested : 
1. Cloning the repo in another folder
2. use `rm -rf ./.git` **within the sub-folder**
3. (This one I used myself) move all of the contents of the subfolder to your project root using : `mv ./sub-folder/* . `

## Note 2: .htaccess infinite redirection  

So I spent a couple of hours trying to understand why this line from `.htaccess` caused infinite redirection . I got this error from the log file in xampp : 
```text
[Wed May 14 10:29:43.291565 2025] [core:error] [pid 49162] [client ::1:61584] AH00124:
 Request exceeded the limit of 10 internal redirects due to 
 probable configuration error. Use 'LimitInternalRecursion' to increase the limit
 if necessary. Use 'LogLevel debug' to get a backtrace., 
 referer: http://localhost/redux-in-action-book-api/
```

The malicious rule : `RewriteRule .* public/$0 [L]` . 

I thought problem originated from `$0` as chat told me that this doesn't exist in apache . But after reading in the docs, I found that this info [is mentioned in the docs under 'regular expression' part](https://httpd.apache.org/docs/2.4/glossary.html) .  

And to quote from the docs :   
> `$0` a special variable that holds back reference to the whole matched expression . 


Personally, I don't understand why this line `RewriteRule ^ public/index.php [L]` works . Isn't `^` supposed to match the beginning of a pattern to match (and on using `preg_match()` using only `^` as the pattern matches nothing) ?

I asked chat but wasn't convinced by his explanations . And I came here to make an api not to be a master in apache (although I think learning it is important), so I will defer having an answer to this for now (I hope this doesn't increase my technical debt :) . 

## Note 3: You can't call a `protected` method in a parent class outside of the inheritance hierarchy
Given this situation:
```php
Task::create([]); // Error: Undefined method 'create'
```
Although that this method is defined in the `Model` class, I am getting this error!  
After asking chat, he told me that since this method is `protected`, we can't call it outside of the inheritance hierarchy.  
In other words, we can call it in the `Model` class or any subclass of it, but NOT in the client code (like the example above).  

That's why I made the method in the `Model` public.  
Another solution was to :
```php
class Task extends Model {
  // You can't name the method as 'create' because this will conflict with the parent class method
 public static function createTask($data) {
    return static::create($data);
  }
}
```
But I think there is no need to create a wrapper for the method of the parent class, we can just make it `public` and call it directly.

