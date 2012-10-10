Goatherd word processing library for PHP
========================================

Goatherd Library provides a collection of text processing and data mining features for PHP 5.4.

The design concentrates on model abstraction, data structures and word processing
(in the abstract sense: arbitrary sequences over arbitrary sets).

A side effect is a basic collection of pseudo-threading and console task helpers.

Standards
---------

Goatherd Library will approximate coding conventions of the Zend Framework.

Features pass a proposal and draft state before they are implemented in a test-driven approach
(and the process made public starting in 2013).
Intensive profiling is used for critical components (like data structures) to provide the best
performance and user guides.

Note however that the results will mostly be designed to suit my design needs and might not be
considered anything higher than beta level for any other use case.
New features are marked as alpha for some time and should be handled with care.
A more robust approach will be considered for the 1.1-branch.

Roadmap
-------

 * October 2012 (scheduled)
   * generic daemon (and init.d like capabilities)
   * generic forking (pool) with shared memory IPC
   * primitive load balancing daemon (load is proxied to proces pool)
 * Early 2013
   * beta-release of 1.0-branch
   * proposals for syntax processing tasks
   * documentation
