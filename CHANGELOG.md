## v1.2

Cleanup and formating option.
  
  * You can now request unformated field data, either by passing a third bool false parameter to `getField` or by passing bool false with the key "format" as an argument for a field in `getFields`.
  * `getField` and `getFields` are now a little bit more elegant, thanks to some small epiphanies.

## v1.1

Fix for callbacks.
  
  * Fixed: Using a callback without additional args (beyond the returned fields) caused an error.


## v1.0

Inital release!

  * Implements basic functionality
  * Current functionality is pulled directly from a previous implementation, and may need additional tweaking