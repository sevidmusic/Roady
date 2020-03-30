<pre>
/////////////////////////////////////////////////////////////////////

 ____                _  _                  ____
|  _ \   __ _  _ __ | |(_) _ __    __ _   / ___| _ __ ___   ___
| | | | / _` || '__|| || || '_ \  / _` | | |    | '_ ` _ \ / __|
| |_| || (_| || |   | || || | | || (_| | | |___ | | | | | |\__ \
|____/  \__,_||_|   |_||_||_| |_| \__, |  \____||_| |_| |_||___/
                                  |___/

/////////////////////////////////////////////////////////////////////


Experimental re-design of the Darling Cms.


Check out the YouTube channel for updates, news, guides, and tutorials.

https://www.youtube.com/channel/UCfR-CPqfSIvCFnYT1m4s66w

Newest videos:

- Creating New Components for the DDMS/Darling Cms Re-design via newComponent.sh: https://youtu.be/FCxDqxLHPhs

#############################################

 _____
|     |
| Key |
|_____|

Vertical  Reference:

      *             |             %
      *             |             %
      *             |             %
      *             |             %
Implementation   Extension    Injection


Horizontal Reference:

* * * * * = Implementation
--------- = Extension
% % % % % = Injection

#############################################



 ________________________                ___________________                 _____________________
|  Identifiable         |               |  Classifiable     |               |  Switchable         |
|||||||||||||||||||||||||               |||||||||||||||||||||               |||||||||||||||||||||||
|                       |               |                   |               |                     |
| getName(): string     |               | getType(): string |               | getState(): bool    |
| getUniqueId(): string |               |_______ __ ________|               | switchState(): bool |
|_________ __ __________|                       *  |                        |________ __ _________|
          *  |                                  *  |                                 *  %
          *  |                                  *  |                                 *  %
          *  |                                  *  |                                 *  %
          *  |                                  *  |                                 *  %
 _________*__|___________                 ______*__|_______                          *  %
|  Storable              |               |  Exportable     |                         *  %
||||||||||||||||||||||||||               |||||||||||||||||||                         *  %
| ...                    |               | ...             |                         *  %
| getLocation(): string  |               | export(): array |                         *  %
| getContainer(): string |               | import(): bool  |                         *  %
|_______ __ _____________|               |______ __ _______|                         *  %
        *  %                                    *  |                                 *  %
        *  %                                    *  |                                 *  %
        *  %                                    *  |                                 *  %
        *  %                                    *  |                                 *  %
        *  %                                    *  |                                 *  %
        *  %                                    *  |                                 *  %
        *  %                                    *  |                                 *  %
        *  %                              ______*__|_______________          ________*__%___________
        *  %                             |  Component              |        |  SwitchableComponent  |
        *  %                             |||||||||||||||||||||||||||        |||||||||||||||||||||||||
        *  % % % % % % % % % % % % % % % | ...                     |        | ...                   |
        *                                | getName(): string       |* * * * | getState(): bool      |
        * * * * * * * * * * * * * * * * *| getUniqueId(): string   |--------| switchState(): bool   |
                                         | getLocation(): string   |        |_______________________|
                                         | getConatiner(): string  |
                                         |_________________________|


</pre>

