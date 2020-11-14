<div class="output font-concert-one">
    <div class="landing-page-menu">
        <ul class="landing-page-links">
            <li><a href="./index.php?howItWorks#phillosophy">How the Darling Data Management System Works</a></li>
    </div>
    <p>
        The Darling Data Management System is a tool
        designed to aide in the development of well
        organized PHP applications.
    </p>
    <p id="phillosophy">
        All software, regardless of what it's purpose
        is, is dealing with data.
    </p>
    <p>
        From the perspective of a computer, everything
        is justa series of 0s and 1s, i.e., data.
    </p>
    <p>
        From the perspective of humans, regardless
        of what language is used to develop a piece
        of software, somwhere a human writes what
        is really just plain text formated according
        to the semantic rules of the programming
        language in use, i.e. data.
    </p>
    <p>
        In the same way the humans, dogs, and cats
        are all mamals, everything in the DDMS is
        data, meaning it is defined and implemented
        as a data structure.
    </p>
    <p>
        To provide a tangible example, an argument
        could be made that a common property of
        all data is that it can be identified, i.e.,
        has an identifier of some kind.
    </p>
    <p>
        The DDMS implements this idea in the core
        Identifiable interface, which defines the
        contract of an object that has a name, and
        a unique id.
    </p>
    <p>
        Another example, it is often the case that
        data has a boolean state associated with it,
        the DDMS implements this idea in the core
        Switchable interface, which defines the
        contract of an object whose state can
        be switched from true to false.
    </p>
    <p>
        A final example, data is often stored, e.g., in
        a database, in a file, etc. The DDMS defines
        a Storable interface which defines the contract
        of a data structure that can be stored.
    </p>
    <p>
        Some of these abstractions probably seem like
        overkill, but the point is to identify common
        characteristics of all data. Data is usually
        identifiable, data is often storable, data
        often has boolean state, defining interfaces
        to reflect these concepts allows for more
        complicated data structures to be built upon
        these simple abstractions while maintaining
        a common set of expectations for all data
        in a piece of software.
    </p>
    <p>
        This makes managing data much easier, and
        makes it possible to manage things that
        may not typically be implemented as data,
        in the same way everything else is managed.
    </p>
</div>

