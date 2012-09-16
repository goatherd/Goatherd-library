Goatherd word processing library for PHP
========================================

Goatherd Library provides a collection of text processing and data mining features for PHP 5.4.

The design focuses on model abstraction, data structures and word processing
(in the abstract sense: arbitrary sequences over arbitrary sets).

Standards
---------

Goatherd Library will follow coding conventions of the Zend Framework.
Features pass a proposal and draft state before they are implemented in a test-driven approach.
Intensive profiling is used for critical components (like data structures) to provide the best performance and user guides.

Note however that the results will mostly be designed to suit my design needs and might not be considered anything more than beta level for any other use case.
New features are marked as alpha for some time. Incubation is not yet used.

Roadmap
-------

 * October 2012 (scheduled)
   * generic daemon (and init.d like capabilities)
   * generic forking (pool) with shared memory IPC
   * primitive load balancing daemon (load is proxied to proces pool)
 * September 2012
   * Basic word tree capabilities: trie, digital search tree, directed acyclic word graphs
   * Generic collections and entities (class and trait)

