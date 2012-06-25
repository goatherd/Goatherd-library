Goatherd word processing library for PHP
========================================

Collection of content/ text processing features for PHP


Goatherd Library provides a set of single class files and components useful to build content processing and analysis tools.

The design focuses on model abstraction, data structures and word processing
(the mathematical meaning of word: arbitrary sequences over arbitrary sets).

Requirements
------------

 * PHP 5.4
 * SPL v.0.2 

Some components might still run with PHP 5.3 for some time.
It is not recommended thought, as performance is worse for the interesting parts
(like arrays and serialisation for example).

Standards
---------

Goatherd Library will closely follow coding conventions of the Zend Framework.
Features pass a proposal and draft state before they are implemented in a test-driven approach.
Intensive profiling is used for critical components (like data structures).

Note however that the results will mostly be designed to suit my needs and might not be considered anything higher than
beta level for any other use case. New features are thus marked as alpha for some time.

History
-------

Initially some data structures will be provided like digital search tree (trie) and generic collection implementations.

The first alpha release is scheduled for 15th July 2012.

Future
------

The next minor release should add source code analysis support (PHP). Release date around October 2012.

Starting there first document analysis features might be added.

As a side-project some MongoDB and content retrieval features are intended for late 2012/ early 2013.