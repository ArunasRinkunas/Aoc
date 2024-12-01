package main

import (
	"bufio"
	"fmt"
	"os"
	"strconv"
	"strings"
)

func main() {
	file, err := os.Open("inputs/day01.txt")
	if err != nil {
		fmt.Println("couldn't read the file")
	}
	leftGroup := []int{}
	rightGroup := []int{}
	sum := []int{}

	scanner := bufio.NewScanner(file)
	for scanner.Scan() {
		line := scanner.Text()

		splitString := strings.Split(line, " ")

		leftNumber, _ := strconv.Atoi(splitString[0])
		leftGroup = append(leftGroup, leftNumber)

		rightNumber, _ := strconv.Atoi(splitString[3])
		rightGroup = append(rightGroup, rightNumber)
	}

	for _, leftNumber := range leftGroup {
		count := 0
		for _, rightNumber := range rightGroup {
			if leftNumber == rightNumber {
				count++
			}
		}
		if count > 0 {
			sum = append(sum, leftNumber*count)
			// fmt.Println(sum)
			// os.Exit(1)
		}

		// indexMinNumberInRightGroup := slices.Index(rightGroup, minNumberInRightGroup)
		// fmt.Println(indexMinNumberInLeftGroup);

	}
	// fmt.Println(sum)
	// os.Exit(1)
	// for len(leftGroup) > 0 && len(rightGroup) > 0 {
	// 	minNumberInLeftGroup := slices.Min(leftGroup)
	// 	indexMinNumberInLeftGroup := slices.Index(leftGroup, minNumberInLeftGroup)

	// 	minNumberInRightGroup := slices.Min(rightGroup)
	// 	indexMinNumberInRightGroup := slices.Index(rightGroup, minNumberInRightGroup)

	// 	difference := minNumberInLeftGroup - minNumberInRightGroup
	// 	if difference < 0 {
	// 		difference = -difference
	// 	}

	// 	sum = append(sum, difference)
	// 	leftGroup = append(leftGroup[:indexMinNumberInLeftGroup], leftGroup[indexMinNumberInLeftGroup+1:]...)
	// 	rightGroup = append(rightGroup[:indexMinNumberInRightGroup], rightGroup[indexMinNumberInRightGroup+1:]...)
	// }
	sumOfArray(sum)
}

func sumOfArray(sum []int) {
	result := 0

	for i := 0; i < len(sum); i++ {
		result += sum[i]
	}
	println(result)
}
