## 612136 TODD PERRY
## University Of Portsmouth
## Python Coursework


from random import *
from graphics import *
import math
import time

##############advanced##################


def getMouseClick(win):
    # returns x and y of mouse click
    mouseClick = win.getMouse()
    x = mouseClick.getX()
    y = mouseClick.getY()
    return x, y

def getPatchDetails(xRange, yRange, x, y, patterns):
    counter = 0
    patternStartX = int(x / 100) * 100
    patternStartY = int(y / 100) * 100
    for i in range(0, xRange, 100):
        for j in range(0, yRange, 100):
            # searches coordonits
            if patternStartX  == i and patternStartY == j:
                patchToSwap = patterns[counter]
                # counter is like the ID, uses the same method as the drawing does
            counter = counter + 1
    return patchToSwap



def clearSpace(win, x, y):
    drawRectangle(win, Point(x, y), Point((x + 100), (y + 100)), "white")
    
    
def patternSwap(p1, p2, var):
    copy = p1[:]
    p1[var] = p2[var]
    p2[var] = copy[var]
    return p1, p2
    

    
def swapPatchwork(patterns, xRange, yRange, win):
    while True:
        x1, y1 = getMouseClick(win)
        x2, y2 = getMouseClick(win)
        patchToSwap1 = getPatchDetails(xRange, yRange, x1, y1, patterns)
        patchToSwap2 = getPatchDetails(xRange, yRange, x2, y2, patterns)



        # deletes current designs
        clearSpace(win, patchToSwap1[1], patchToSwap1[2])
        clearSpace(win, patchToSwap2[1], patchToSwap2[2])

        # draws new designs   [turn into seperate function, code is messy]
        if patchToSwap1[0] == 1:
            drawPattern1(win, patchToSwap2[1], patchToSwap2[2], patchToSwap1[3])
        else:
            drawPattern2(win, patchToSwap2[1], patchToSwap2[2], patchToSwap1[3])

        if patchToSwap2[0] == 1:
            drawPattern1(win, patchToSwap1[1], patchToSwap1[2], patchToSwap2[3])
        else:
            drawPattern2(win, patchToSwap1[1], patchToSwap1[2], patchToSwap2[3])

        # swaps patch details 
        # only swap pattern and col, not coords
        patchToSwap1, patchToSwap2 = patternSwap(patchToSwap1, patchToSwap2, 0)
        patchToSwap1, patchToSwap2 = patternSwap(patchToSwap1, patchToSwap2, 3)


        

        

        
                
                
            
                


##############graphics##################

# i use 'div' because each pattern is divided into 10 segments
# each 10 pixels across


def drawLine(win, p1, p2, col):
    line = Line(p1, p2)
    line.draw(win)
    line.setFill(col)

def drawRectangle(win, p1, p2, col):
    rect = Rectangle(p1, p2)
    rect.draw(win)
    rect.setFill(col)
    if col == "white":
        rect.setOutline("white")


def drawPattern2(win, startX, startY, col):
    # this models the patern by doing it in chunks of 4 rectangles at a time
    # analysing the patern and putting it into a for loop
    div = 10 # 100/10,  10 segments
    for i in range(0, 40, 10):
        drawRectangle(win, Point((startX + i), (startY + i)), Point((startX + div + i), ((startY + 90) - i)), col)
    for i in range(0, 40, 10):
        drawRectangle(win, Point((startX + div) + i, (startY + i)), Point((startX + 100) - i, (startY + div) + i), col)
    for i in range(0, 40, 10):
        drawRectangle(win, Point((startX + 90 - i), (startY + div + i)), Point((startX + 100 - i), (startY + 100 - i)), col)
    for i in range(0, 40, 10):
        drawRectangle(win, Point((startX + i), ((startY+90) - i )), Point((startX + 90) - i, (startY + 100) - i), col)
        



def drawPattern1(win, startX, startY, col):
    # this works by letting the beggining and
    # end of the lines slide along the axis
    div = 10 # 100/10,  10 segments
    for x in range(0, 100, 10):
        drawLine(win, Point((startX + x), startY), Point(((startX + 100) - x), startY + 100), col)
    for y in range(100, 0, -10):
        drawLine(win, Point(startX, startY + y), Point((startX + 100), ((startY + 100) - y)), col)
        


def drawPatchwork(height, width, colours):
    #where anything is * by 100, its changing ot from noof pattern to coord
    shift = width % 4 # how much the colour shifs on each line
    patterns = []
    win = GraphWin("Patch Work", (width * 100), (height * 100))
    win.setBackground("white")
    counter = 0
    for x in range(width):
        for y in range(height):
            currentPattern = counter % 2
            currentColour = colours[(x + (y * shift)) % 4]
            if currentPattern == 1:
                drawPattern1(win, (x * 100), (y * 100), currentColour)
                patterns.append([1, (x * 100), (y * 100), currentColour])
            else:
                drawPattern2(win, (x * 100), (y * 100), currentColour)
                patterns.append([2, (x * 100), (y * 100), currentColour])
            
            counter = counter + 1


    return patterns, win
            
            
            
            
    

##############inputs################
def invalidNum(var):
    print("You Have Entered An Invalid ", var)
    print("It Must Be An Integer Between 2 And 8, Try Again")
    

def getNum(var):
    while True:
        while True:
            num = input("Enter Window {0}: ".format(var))
            if num.isnumeric():
                #validates for strings
                num = eval(num)
                break
            else:
                invalidNum(var)
        if num >= 2 and num <= 8 and not type(num) == float:
            break
        else:
            invalidNum(var)
    return num


def validateColour(colour, userColours):
    valid = True
    for i in range(len(userColours)):
        if colour == userColours[i]:
            print("this colour has already been used, select another colour")
            valid = False
    return valid
            
            

def getColour(userCol):
    colours = ["red", "green", "blue", "yellow", "magenta", "cyan"]
    isValid = False
    while True:
        chosenCol = input("Enter Colour: ")
        valid = validateColour(chosenCol, userCol)
        for i in colours:
            if i == chosenCol:
                isValid = True
                break
        if isValid == True:
            isValid = valid
        if isValid == True:
            userCol.append(chosenCol)
            break
        else:
            print("Invalid Colour, Please Try Again")
    return chosenCol


def getInput():
    height = getNum("Height")
    width = getNum("Width")
    selectedCol = []
    colour1 = getColour(selectedCol)
    colour2 = getColour(selectedCol)
    colour3 = getColour(selectedCol)
    colour4 = getColour(selectedCol)
    colours = [colour1, colour2, colour3, colour4]

    return height, width, colours
    
################main################    
                      

def main():
    height, width, colours = getInput()
    patterns, win = drawPatchwork(height, width, colours)
    swapPatchwork(patterns, height * 100, width * 100, win)

main()


