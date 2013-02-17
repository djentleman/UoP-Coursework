-- 
-- 
-- MATHFUN - DISCRETE MATHEMATICS AND FUNCTIONAL PROGRAMMING
-- Functional Programming Assignment, 2012/13
-- UP612136
--

--         --
----Types----
--         --

data Film = Film String [String] Int [String] -- Title, Cast, Year, Fans
                 deriving (Eq, Ord, Show, Read)


--                   --
----Functional Code----
--                   --


addNewFilm :: Film -> [Film] -> [Film]
addNewFilm filmToAdd films = filmToAdd : films

isYear :: Int -> Film -> Bool
isYear year (Film _ _ filmYear _)
    |year == filmYear = True
    |otherwise = False
	
getFilmsByYear year  = filter (isYear year) -- filters for year

isFan :: String -> Film -> Bool
isFan person (Film _ _ _ []) =  False
isFan person (Film name actors year (fan:fans))
	|person == fan = True || (isFan person (Film name actors year fans))
	|otherwise = (isFan person (Film name actors year fans))
	
getFilmsByFan person = filter (isFan person)

addFanToFilm :: String -> Film -> Film
addFanToFilm newFan (Film name actors year fans) = (Film name actors year (newFan:fans))

--                  --
----Interface Code----
--                  --

	
loadFilms :: IO [Film]
loadFilms = do
    filmStr <- readFile "films.txt"
    let films = (read filmStr :: [Film])
    putStrLn "Films Loaded!"
    return films

saveFilms :: [Film] -> IO ()
saveFilms films = do
    writeFile "films.txt" (show films)
    putStrLn "Films Saved!"
    


	

--input = String, output = IO function  
getMenuChoice :: String -> IO () -- string used as opposed to Int for robustness
getMenuChoice "1" = addFilm
getMenuChoice "2" = viewAllFilms
getMenuChoice "3" = viewFilmsByYear
getMenuChoice "4" = viewFilmsByFan
-- TODO - FINISH THIS FUNCTION
getMenuChoice "9" = exit
getMenuChoice _ = invalidChoice

	
	
menu :: IO ()
menu = do
    putStrLn "            ##############"
    putStrLn "            #PORT  SOLENT#"
    putStrLn "            #FILM  SYSTEM#"
    putStrLn "            ##############"
    putStrLn "(not related to year 1 java in any way!)"
    putStrLn ""
    putStrLn "#-#-#-#-#-#- MENU  SYSTEM -#-#-#-#-#-#"
    putStrLn "Press 1 To Add A Film"
    putStrLn "Press 2 To View All Films"
    putStrLn "Press 3 To Display All Films From A Certain Year"
    putStrLn "Press 4 To Display All Films A User Is A Fan Of"
    putStrLn "Press 5 To Display All Films Released Within A Peticular Period"
    putStrLn "Press 6 To Say You're A Fan Of A Peticular FIlm"
    putStrLn "Press 7 To Display The 'Best' Film"
    putStrLn "Press 8 To Display The 'Top 5' FIlms"
    putStrLn "Press 9 To Exit"
    putStr ">>>"
    choice <- getLine
    getMenuChoice choice
	
invalidChoice :: IO ()
invalidChoice = do
    putStrLn "Invalid Menu Choice"
    menu

-------------ADD FILM-----------------

addFilm :: IO ()
addFilm = do
    title <- getTitle -- would you 'let', but not printing anything
    actors <- getActors []
    releaseYear <- getReleaseYear
    fans <- getFans []
    let film = Film title actors releaseYear fans
    films <- loadFilms -- may remove this line depending on structure of load/save
    let filmsToSave = addNewFilm film films
    putStrLn "Film Has Been Added!"
    listFilms filmsToSave -- permission denied to save without this line
    --- problem will be solved if films is read in from 'main'
    saveFilms filmsToSave -- permission denied? 
    menu

getTitle :: IO String
getTitle = do
    putStrLn "Enter Film Title"
    putStr ">>>"
    title <- getLine
    return title
	
getActors :: [String] -> IO [String]
getActors actors = do
    putStrLn "Enter Actor Name (enter empty string to finish entering actors)"
    putStr ">>>"
    actorToAdd <- getLine
    if actorToAdd == ""
        then return actors
        else do getActors (actorToAdd : actors)

getReleaseYear :: IO Int
getReleaseYear = do
    putStrLn "Enter Year Of Release"
    putStr ">>>"
    releaseYear <- getLine
    return (read releaseYear :: Int)

getFans :: [String] -> IO [String]
getFans fans = do
    putStrLn "Enter Fan Name (enter empty string to finish entering fans)"
    putStr ">>>"
    fanToAdd <- getLine
    if fanToAdd == ""
        then return fans
        else do getFans (fanToAdd : fans)
    
	
--------------VIEW ALL FILMS---------------
	
viewAllFilms :: IO ()
viewAllFilms = do
    films <- loadFilms
    putStrLn "List Of Films:"
    listFilms films
    menu

listFilms :: [Film] -> IO ()
listFilms (film:films) = do
    filmPrintOut film
    if films == []
        then return ()
        else do listFilms films

-------------------VIEW FILMS BY YEAR------------
		
		
viewFilmsByYear :: IO ()
viewFilmsByYear = do
    putStrLn "Enter A Year To Search"
    putStr ">>>"
    year <- getLine
    films <- loadFilms
    let filmsByYear = getFilmsByYear (read year ::	Int) films
    if filmsByYear == []
        then do putStrLn "No Films Found"
                menu
        else do listFilms filmsByYear
                menu

--------------------VIEW FILMS BY FAN--------------------------
	
viewFilmsByFan :: IO ()
viewFilmsByFan = do
    putStrLn "Enter A Fan To Search"
    putStr ">>>"
    person <- getLine
    films <- loadFilms
    let filmsByFan = getFilmsByFan person films
    if filmsByFan == []
        then do putStrLn "No Films Found"
                menu
        else do listFilms filmsByFan
                menu
    menu
	
----------------EXIT----------------------------------

exit :: IO ()
exit = do
    putStrLn "Thank You For Using The Program"
    putStrLn "Please Use It Again! :D"
	

--------------FILM PRINT OUT----------------------------------
	
filmPrintOut :: Film -> IO ()
filmPrintOut (Film title actors releaseYear fans) = do
    putStrLn "--------------------"
    printTitle title
    putStr "Starring: "
    printStringArray actors
    putStrLn "" -- new line
    printReleaseYear releaseYear
    putStr "Fans: "
    printStringArray fans
    putStrLn "" -- new line

printTitle :: String -> IO ()
printTitle title = do
    putStr "Title: "
    putStrLn title

printStringArray :: [String] -> IO ()
printStringArray (str:strs) = do
    putStr str
    putStr ", "
    if strs == []
        then return () 
        else do printStringArray strs

printReleaseYear :: Int -> IO ()
printReleaseYear year = do
    putStr "Release Year: "
    putStrLn (show year)
	

---------------------------------------------------------------
	

--        --
----Main----
--        --

main :: IO ()
main = do
    --films <- loadFilms -- 'films' holds the String from the text file
    menu
	


--                    --
----Demo Information----
--                    --



-- Demo function to test basic functionality (without persistence - i.e. 
-- testDatabase doesn't change and nothing is saved/loaded to/from file).




--demo :: Int -> IO ()
--demo 1  = putStrLn all films after adding 2013 film "The Great Gatsby"
-- starring "Leonardo DiCaprio" and "Tobey Maguire" to testDatabase
--demo 2  = putStrLn (fnToTurnAListOfFilmsIntoAMultiLineString testDatabase)
--demo 3  = putStrLn all films from 2012
--demo 4  = putStrLn all films that "Zoe" is a fan of
--demo 5  = putStrLn all "Tom Hanks" films from 2000 until 2011
--demo 6  = putStrLn all films after "Zoe" becomes fan of "Forrest Gump"
--demo 61 = putStrLn all films after "Zoe" becomes fan of "Inception"
--demo 7  = putStrLn best "Tom Hanks" film
--demo 8  = putStrLn top 5 films

--             --
----Test Data----
--             --

testDatabase :: [Film]
testDatabase = [ 
    (Film 
	    "Casino Royale" 
	    ["Daniel Craig", "Eva Green", "Judi Dench"] 
	    2006 
	    ["Garry", "Dave", "Zoe", "Kevin", "Emma"]), 
    (Film 
	    "Cowboys & Aliens"
	    ["Harrison Ford", "Daniel Craig", "Olivia Wilde"]
	    2011
	    ["Bill", "Jo", "Garry", "Kevin", "Olga", "Liz"]), 
    (Film
	    "Catch Me If You Can"
	    ["Leonardo DiCaprio", "Tom Hanks"]
	    2002
	    ["Zoe", "Heidi", "Jo", "Emma", "Liz", "Sam", "Olga", "Kevin", "Tim"]), 
    (Film
        "Mamma Mia!"
        ["Meryl Streep", "Pierce Brosnan"]
        2008
        ["Kevin", "Jo", "Liz", "Amy", "Sam", "Zoe"]),
    (Film
        "Saving Private Ryan"
        ["Tom Hanks", "Matt Damon"]
        1998
        ["Heidi", "Jo", "Megan", "Olga", "Zoe", "Wally"]),
    (Film
        "Life of Pi" 
        ["Suraj Sharma"]
        2012
        ["Kevin", "Olga", "Liz", "Tim", "Zoe", "Paula", "Jo", "Emma"]),
    (Film
        "Titanic"
        ["Leonardo DiCaprio", "Kate Winslet"]
        1997
        ["Zoe", "Amy", "Heidi", "Jo", "Megan", "Olga"]),
    (Film
        "Quantum of Solace"
        ["Daniel Craig", "Judi Dench"]
        2008
        ["Bill", "Olga", "Tim", "Zoe", "Paula"]),
    (Film
        "You've Got Mail"
        ["Meg Ryan", "Tom Hanks"]
        1998
        ["Dave", "Amy"]),
    (Film
        "Collateral"
        ["Tom Cruise", "Jamie Foxx"]
        2004
        ["Dave", "Garry", "Megan", "Sam", "Wally"]),
    (Film
        "The Departed"
        ["Leonardo DiCaprio", "Matt Damon", "Jack Nicholson"]
        2006
        ["Zoe", "Emma", "Paula", "Olga", "Dave"]),
    (Film
        "Inception"
        ["Leonardo DiCaprio"]
        2010
        ["Chris", "Emma", "Jo", "Bill", "Dave", "Liz", "Wally", "Zoe", "Amy", "Sam", "Paula", "Kevin", "Olga"]),
    (Film
        "Up in the Air"
        ["George Clooney", "Vera Farmiga"]
        2009
        ["Wally", "Liz", "Kevin", "Tim", "Emma"]),
    (Film
        "The Shawshank Redemption"
        ["Tim Robbins", "Morgan Freeman"]
        1994
        ["Jo", "Wally", "Liz", "Tim", "Sam", "Zoe", "Emma", "Garry", "Olga", "Kevin"]),
    (Film
        "Gladiator"
        ["Russell Crowe", "Joaquin Phoenix"]
        2000
        ["Garry", "Ian", "Neal"]),
    (Film
        "The King's Speech"
        ["Colin Firth", "Geoffrey Rush"]
        2010
        ["Garry", "Megan", "Sam", "Ian", "Bill", "Emma", "Chris"]),
    (Film
        "The Descendants"
        ["George Clooney"]
        2011
        ["Wally", "Liz", "Kevin", "Tim", "Emma", "Chris", "Megan"]),
    (Film
        "Cloud Atlas"
        ["Tom Hanks", "Halle Berry"]
        2012
        ["Dave", "Amy", "Garry", "Ian", "Neal"]),
    (Film
        "The Reader"
        ["Kate Winslet", "Ralph Fiennes"]
        2008
        ["Emma", "Bill", "Dave", "Liz"]),
    (Film
        "Minority Report"
        ["Tom Cruise"]
        2002
        ["Dave", "Garry", "Megan", "Sam", "Wally"]),
    (Film
        "Revolutionary Road"
        ["Leonardo DiCaprio", "Kate Winslet"]
        2008
        ["Wally", "Sam", "Dave", "Jo"]),
    (Film
        "Forrest Gump"
        ["Tom Hanks"]
        1994
        ["Ian", "Garry", "Bill", "Olga", "Liz", "Sam", "Dave", "Jo", "Chris", "Wally", "Emma"]),
    (Film
        "Larry Crowne"
        ["Tom Hanks", "Julia Roberts"]
        2011
        ["Liz", "Wally"]),
    (Film
        "The Terminal"
        ["Tom Hanks", "Catherine Zeta Jones"]
        2004
        ["Olga", "Heidi", "Bill", "Sam", "Zoe"]),
    (Film
        "Django Unchained"
        ["Jamie Foxx", "Leonardo DiCaprio", "Christoph Waltz"]
        2012
        ["Kevin", "Tim", "Emma", "Olga"  ])
    ]
