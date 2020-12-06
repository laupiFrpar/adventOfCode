def getListFromFile(day):
  f = open('data/day{}.txt'.format(day))
  list = f.read().splitlines()
  f.close()

  return list

def displayPart(partName, result):
  print('part {} : {}'.format(partName, result))

def displayPartOne(result):
  displayPart('one', result)

def displayPartTwo(result):
  displayPart('two', result)
