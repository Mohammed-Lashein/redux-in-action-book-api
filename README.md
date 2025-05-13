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